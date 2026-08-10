<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\CallSignal;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $targetUserId = $request->query('user_id');
        $targetUser = null;
        if ($targetUserId) {
            $targetUser = User::find($targetUserId);
        }

        return view('chat.index', compact('user', 'targetUser'));
    }

    public function getConversations(Request $request)
    {
        $authId = auth()->id();
        if (!$authId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        try {
            $search = $request->query('search');

            // Fetch registered users excluding auth user
            $usersQuery = User::where('id', '!=', $authId);
            if ($search) {
                $usersQuery->where('name', 'like', '%' . $search . '%');
            }
            $users = $usersQuery->take(50)->get();

            // Fetch last messages batch
            $lastMessages = ChatMessage::where('sender_id', $authId)
                ->orWhere('receiver_id', $authId)
                ->latest()
                ->get()
                ->groupBy(function ($msg) use ($authId) {
                    return $msg->sender_id == $authId ? $msg->receiver_id : $msg->sender_id;
                });

            // Fetch unread counts batch
            $unreadCounts = ChatMessage::where('receiver_id', $authId)
                ->where('is_read', false)
                ->get()
                ->groupBy('sender_id');

            $conversations = [];
            foreach ($users as $u) {
                $userMsgs = $lastMessages->get($u->id);
                $lastMsg = $userMsgs ? $userMsgs->first() : null;
                $unread = $unreadCounts->get($u->id);
                $unreadCount = $unread ? $unread->count() : 0;

                $formattedTime = '';
                if ($lastMsg) {
                    $formattedTime = $lastMsg->created_at->isToday()
                        ? $lastMsg->created_at->format('g:i A')
                        : $lastMsg->created_at->format('M j');
                }

                $conversations[] = [
                    'id' => $u->id,
                    'name' => $u->name,
                    'avatar_url' => $u->profile_photo_url,
                    'initial' => strtoupper(substr($u->name ?? 'U', 0, 1)),
                    'last_message' => $lastMsg ? ($lastMsg->message ?: ($lastMsg->attachment_type ? '[' . ucfirst($lastMsg->attachment_type) . ']' : 'Attachment')) : 'Start a conversation',
                    'last_time' => $formattedTime,
                    'unread_count' => $unreadCount,
                ];
            }

            // Sort by unread first, then recent messages
            usort($conversations, function ($a, $b) {
                return $b['unread_count'] <=> $a['unread_count'];
            });

            $totalUnread = ChatMessage::where('receiver_id', $authId)->where('is_read', false)->count();

            return response()->json([
                'status' => 'success',
                'total_unread' => $totalUnread,
                'conversations' => $conversations,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'success',
                'total_unread' => 0,
                'conversations' => [],
            ]);
        }
    }

    public function getMessages(Request $request, $userId)
    {
        $authId = auth()->id();
        if (!$authId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $targetUser = User::findOrFail($userId);

        // Mark messages from target user as read
        ChatMessage::where('sender_id', $targetUser->id)
            ->where('receiver_id', $authId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = ChatMessage::where(function ($q) use ($authId, $targetUser) {
            $q->where('sender_id', $authId)->where('receiver_id', $targetUser->id);
        })->orWhere(function ($q) use ($authId, $targetUser) {
            $q->where('sender_id', $targetUser->id)->where('receiver_id', $authId);
        })
        ->orderBy('created_at', 'asc')
        ->take(100)
        ->get();

        $formatted = [];
        foreach ($messages as $m) {
            $timeAgo = $m->created_at->isToday()
                ? $m->created_at->format('g:i A')
                : $m->created_at->format('M j, g:i A');

            $formatted[] = [
                'id' => $m->id,
                'sender_id' => $m->sender_id,
                'is_self' => $m->sender_id == $authId,
                'message' => $m->message,
                'attachment_type' => $m->attachment_type,
                'attachment_url' => $m->attachment_url ? asset('storage/' . $m->attachment_url) : null,
                'time_ago' => $timeAgo,
            ];
        }

        return response()->json([
            'status' => 'success',
            'target_user' => [
                'id' => $targetUser->id,
                'name' => $targetUser->name,
                'avatar_url' => $targetUser->profile_photo_url,
                'initial' => strtoupper(substr($targetUser->name ?? 'U', 0, 1)),
            ],
            'messages' => $formatted,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $authId = auth()->id();
        if (!$authId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string|max:2000',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi,mkv,webm|max:51200',
        ]);

        $receiverId = $request->receiver_id;
        $attachmentType = null;
        $attachmentUrl = null;

        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $file = $request->file('attachment');
            $mime = $file->getMimeType();

            if (str_contains($mime, 'image')) {
                $attachmentType = 'image';
                $attachmentUrl = $file->store('chat/images', 'public');
            } elseif (str_contains($mime, 'video')) {
                $attachmentType = 'video';
                $attachmentUrl = $file->store('chat/videos', 'public');
            } else {
                $attachmentType = 'file';
                $attachmentUrl = $file->store('chat/files', 'public');
            }
        }

        if (empty($request->message) && !$attachmentUrl) {
            return response()->json(['status' => 'error', 'message' => 'Message or attachment required'], 422);
        }

        $msg = ChatMessage::create([
            'sender_id' => $authId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'attachment_type' => $attachmentType,
            'attachment_url' => $attachmentUrl,
            'is_read' => false,
        ]);

        // Send notification
        UserNotification::createNotification(
            $receiverId,
            $authId,
            'chat',
            'New Message 💬',
            auth()->user()->name . ': ' . (\Illuminate\Support\Str::limit($request->message ?: '[' . ucfirst($attachmentType) . ']', 30)),
            '/chat?user_id=' . $authId
        );

        $timeAgo = $msg->created_at->format('g:i A');

        return response()->json([
            'status' => 'success',
            'message' => [
                'id' => $msg->id,
                'sender_id' => $msg->sender_id,
                'is_self' => true,
                'message' => $msg->message,
                'attachment_type' => $msg->attachment_type,
                'attachment_url' => $msg->attachment_url ? asset('storage/' . $msg->attachment_url) : null,
                'time_ago' => $timeAgo,
            ]
        ]);
    }

    public function markRead(Request $request, $userId)
    {
        $authId = auth()->id();
        if (!$authId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        ChatMessage::where('sender_id', $userId)
            ->where('receiver_id', $authId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }

    // CALL SIGNALING ENDPOINTS
    public function sendCallSignal(Request $request)
    {
        $authId = auth()->id();
        if (!$authId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'action' => 'required|in:initiate,accept,decline,end',
            'type' => 'nullable|in:audio,video',
            'sdp' => 'nullable|string',
        ]);

        $receiverId = $request->receiver_id;
        $action = $request->action;
        $type = $request->type ?: 'audio';

        if ($action === 'initiate') {
            // End old active signals between these two users
            CallSignal::where(function ($q) use ($authId, $receiverId) {
                $q->where('caller_id', $authId)->where('receiver_id', $receiverId);
            })->orWhere(function ($q) use ($authId, $receiverId) {
                $q->where('caller_id', $receiverId)->where('receiver_id', $authId);
            })->update(['status' => 'ended']);

            $signal = CallSignal::create([
                'caller_id' => $authId,
                'receiver_id' => $receiverId,
                'type' => $type,
                'status' => 'ringing',
                'sdp_offer' => $request->sdp,
            ]);

            return response()->json(['status' => 'success', 'signal_id' => $signal->id]);
        } elseif ($action === 'accept') {
            CallSignal::where('caller_id', $receiverId)
                ->where('receiver_id', $authId)
                ->where('status', 'ringing')
                ->update(['status' => 'accepted', 'sdp_answer' => $request->sdp]);

            return response()->json(['status' => 'success']);
        } elseif ($action === 'decline' || $action === 'end') {
            CallSignal::where(function ($q) use ($authId, $receiverId) {
                $q->where('caller_id', $authId)->where('receiver_id', $receiverId);
            })->orWhere(function ($q) use ($authId, $receiverId) {
                $q->where('caller_id', $receiverId)->where('receiver_id', $authId);
            })->update(['status' => $action === 'decline' ? 'declined' : 'ended']);

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 400);
    }

    public function checkCallSignals(Request $request)
    {
        $authId = auth()->id();
        if (!$authId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Check for incoming ringing calls
        $incoming = CallSignal::with('caller')
            ->where('receiver_id', $authId)
            ->where('status', 'ringing')
            ->where('created_at', '>=', now()->subSeconds(40))
            ->latest()
            ->first();

        // Check for state update of outgoing call
        $outgoing = CallSignal::where('caller_id', $authId)
            ->where('created_at', '>=', now()->subSeconds(60))
            ->latest()
            ->first();

        return response()->json([
            'status' => 'success',
            'incoming_call' => $incoming ? [
                'id' => $incoming->id,
                'caller_id' => $incoming->caller_id,
                'caller_name' => $incoming->caller->name ?? 'User',
                'caller_avatar' => $incoming->caller->profile_photo_url,
                'type' => $incoming->type,
                'sdp_offer' => $incoming->sdp_offer,
            ] : null,
            'outgoing_status' => $outgoing ? [
                'id' => $outgoing->id,
                'receiver_id' => $outgoing->receiver_id,
                'status' => $outgoing->status,
                'sdp_answer' => $outgoing->sdp_answer,
            ] : null,
        ]);
    }
}
