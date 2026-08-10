<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reaction;
use App\Models\Report;
use App\Models\PostView;
use App\Models\StarTransaction;
use App\Models\UserNotification;
use App\Models\User;
use App\Models\Story;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private function checkBlockedUser()
    {
        if (auth()->check() && auth()->user()->is_blocked) {
            abort(403, 'Your account has been blocked by the Administrator.');
        }
    }

    public function index(Request $request)
    {
        $reports = Report::with([
            'user',
            'reactions',
            'comments' => function ($query) {
                $query->whereNull('parent_id')->with(['user', 'replies.user'])->latest();
            }
        ])
        ->withCount(['views', 'starTransactions'])
        ->where('status', 'approved')
        ->latest()
        ->paginate(6);

        $userCountry = auth()->check() ? (auth()->user()->country ?: 'Bangladesh') : 'Bangladesh';
        foreach ($reports as $report) {
            try {
                if (auth()->check()) {
                    PostView::firstOrCreate(
                        ['report_id' => $report->id, 'user_id' => auth()->id()],
                        ['ip_address' => $request->ip(), 'country' => $userCountry]
                    );
                } else {
                    PostView::firstOrCreate(
                        ['report_id' => $report->id, 'ip_address' => $request->ip()],
                        ['country' => $userCountry]
                    );
                }
            } catch (\Exception $e) {
                // Ignore duplicate view race condition
            }
        }

        if ($request->ajax()) {
            return view('partials.posts', compact('reports'))->render();
        }

        $stories = Story::with('user')->where('expires_at', '>', now())->latest()->get();

        return view('index', compact('reports', 'stories'));
    }

    public function toggleReaction(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $this->checkBlockedUser();

        $userId = auth()->id();
        $report = Report::findOrFail($id);

        $reaction = Reaction::where('user_id', $userId)
            ->where('report_id', $id)
            ->first();

        if ($reaction) {
            $reaction->delete();
            $loved = false;
        } else {
            Reaction::create([
                'user_id' => $userId,
                'report_id' => $id,
                'type' => 'love',
            ]);
            $loved = true;

            // Send notification to post author
            if ($report->user_id) {
                UserNotification::createNotification(
                    $report->user_id,
                    $userId,
                    'like',
                    'New Post Reaction ❤️',
                    auth()->user()->name . ' liked your post.',
                    '/#post-card-' . $report->id
                );
            }
        }

        $count = Reaction::where('report_id', $id)->count();

        return response()->json([
            'status' => 'success',
            'loved' => $loved,
            'reactions_count' => $count
        ]);
    }

    public function storeComment(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $this->checkBlockedUser();

        $request->validate([
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $report = Report::findOrFail($id);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'report_id' => $id,
            'parent_id' => $request->parent_id ?: null,
            'comment' => $request->comment,
        ]);

        $comment->load('user');

        // Create Notifications
        if ($request->parent_id) {
            $parentComment = Comment::find($request->parent_id);
            if ($parentComment && $parentComment->user_id) {
                UserNotification::createNotification(
                    $parentComment->user_id,
                    auth()->id(),
                    'comment_reply',
                    'New Comment Reply 💬',
                    auth()->user()->name . ' replied to your comment: "' . \Illuminate\Support\Str::limit($request->comment, 30) . '"',
                    '/#post-card-' . $report->id
                );
            }
        } else {
            if ($report->user_id) {
                UserNotification::createNotification(
                    $report->user_id,
                    auth()->id(),
                    'comment',
                    'New Comment on Post 💬',
                    auth()->user()->name . ' commented on your post: "' . \Illuminate\Support\Str::limit($request->comment, 30) . '"',
                    '/#post-card-' . $report->id
                );
            }
        }

        $count = Comment::where('report_id', $id)->count();

        return response()->json([
            'status' => 'success',
            'comment' => [
                'id' => $comment->id,
                'parent_id' => $comment->parent_id,
                'user_name' => $comment->user->name ?? 'User',
                'user_initial' => strtoupper(substr($comment->user->name ?? 'U', 0, 1)),
                'text' => $comment->comment,
                'time_ago' => $comment->created_at->diffForHumans()
            ],
            'comments_count' => $count
        ]);
    }

    public function sendStars(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $this->checkBlockedUser();

        $request->validate([
            'stars' => 'required|integer|min:1',
            'message' => 'nullable|string|max:255',
        ]);

        $sender = auth()->user();
        $report = Report::findOrFail($id);
        $receiver = $report->user;

        if (!$receiver) {
            return response()->json(['status' => 'error', 'message' => 'Post author not found'], 404);
        }

        if ($sender->id == $receiver->id) {
            return response()->json(['status' => 'error', 'message' => 'You cannot send stars to yourself!'], 400);
        }

        $stars = (int) $request->stars;

        if ($sender->points < $stars) {
            return response()->json([
                'status' => 'error',
                'message' => 'পর্যাপ্ত পয়েন্ট নেই! আপনার আছে ' . $sender->points . ' পয়েন্ট, প্রয়োজন ' . $stars . ' পয়েন্ট।'
            ], 400);
        }

        // Deduct points from sender and add to receiver
        $sender->decrement('points', $stars);
        $receiver->increment('points', $stars);

        // Record star transaction
        $tx = StarTransaction::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'report_id' => $report->id,
            'stars' => $stars,
            'message' => $request->message,
        ]);

        // Send Notification
        UserNotification::createNotification(
            $receiver->id,
            $sender->id,
            'star',
            'You Received Stars ⭐',
            $sender->name . ' sent you ⭐ ' . $stars . ' Stars on your post!',
            '/#post-card-' . $report->id
        );

        return response()->json([
            'status' => 'success',
            'message' => 'সফলভাবে ⭐ ' . $stars . ' Stars পাঠানো হয়েছে!',
            'sender_points' => $sender->fresh()->points
        ]);
    }

    public function getNotifications(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $notifications = auth()->user()->userNotifications()->take(20)->get();
        $unreadCount = auth()->user()->unreadNotificationsCount();

        return response()->json([
            'status' => 'success',
            'unread_count' => $unreadCount,
            'notifications' => $notifications
        ]);
    }

    public function markNotificationsRead(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        auth()->user()->userNotifications()->where('is_read', false)->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('register');
        }
        return view('create');
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('register');
        }

        $this->checkBlockedUser();

        // Check if post has at least text, image(s), or video
        $hasDescription = !empty(trim($request->description ?? ''));
        $hasImages = $request->hasFile('images') || $request->hasFile('image');
        $hasVideo = $request->hasFile('video') || !empty(trim($request->video_url ?? ''));

        if (!$hasDescription && !$hasImages && !$hasVideo) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'পোস্টে অবশ্যই টেক্সট, ছবি অথবা ভিডিও যোগ করুন।'
                ], 422);
            }
            return back()->withErrors(['description' => 'Please enter text, images, or video to post.']);
        }

        $thana = null;
        $district = null;
        $division = null;

        if ($request->division_id && file_exists(public_path('location/divisions.json'))) {
            $divisionsData = json_decode(file_get_contents(public_path('location/divisions.json')), true);
            $divisionsList = $divisionsData[2]['data'] ?? [];
            foreach ($divisionsList as $div) {
                if ($div['id'] == $request->division_id) {
                    $division = $div['bn_name'];
                    break;
                }
            }
        }

        if ($request->district_id && file_exists(public_path('location/districts.json'))) {
            $districtsData = json_decode(file_get_contents(public_path('location/districts.json')), true);
            $districtsList = $districtsData[2]['data'] ?? [];
            foreach ($districtsList as $dist) {
                if ($dist['id'] == $request->district_id) {
                    $district = $dist['bn_name'];
                    break;
                }
            }
        }

        if ($request->location && file_exists(public_path('location/upazilas.json'))) {
            $upazilasData = json_decode(file_get_contents(public_path('location/upazilas.json')), true);
            $upazilasList = $upazilasData[2]['data'] ?? [];
            foreach ($upazilasList as $upazila) {
                if ($upazila['id'] == $request->location) {
                    $thana = $upazila['bn_name'];
                    break;
                }
            }
        }

        $fullLocation = implode(', ', array_filter([$thana, $district, $division]));
        if (empty($fullLocation)) {
            $fullLocation = $request->location;
        }

        // Multiple images upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file && $file->isValid()) {
                    $imagePaths[] = $file->store('reports', 'public');
                }
            }
        }
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $singlePath = $request->file('image')->store('reports', 'public');
            if (!in_array($singlePath, $imagePaths)) {
                array_unshift($imagePaths, $singlePath);
            }
        }

        $firstImage = $imagePaths[0] ?? null;

        // Video upload
        $videoPath = null;
        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }

        // Only set title if explicitly provided; DO NOT auto-fill title from description to prevent duplication
        $title = !empty(trim($request->title ?? '')) ? trim($request->title) : null;

        Report::create([
            'user_id' => auth()->id(),
            'title' => $title,
            'description' => $request->description,
            'location' => $fullLocation,
            'category' => $request->category,
            'image' => $firstImage,
            'images' => !empty($imagePaths) ? $imagePaths : null,
            'video' => $videoPath,
            'video_url' => $request->video_url,
            'status' => 'approved', // Auto-approved by default
            'is_anonymous' => 0
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Post published successfully!'
            ]);
        }

        return redirect('/');
    }

    public function admin()
    {
        $reports = Report::latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function approve($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'approved';
        $report->save();

        if ($report->user_id) {
            UserNotification::createNotification(
                $report->user_id,
                auth()->id(),
                'system',
                'Post Approved ✅',
                'Your post "' . \Illuminate\Support\Str::limit($report->title ?: $report->description, 30) . '" has been approved.',
                '/#post-card-' . $report->id
            );
        }

        return back();
    }

    public function reject($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'rejected';
        $report->save();

        if ($report->user_id) {
            UserNotification::createNotification(
                $report->user_id,
                auth()->id(),
                'system',
                'Post Status Notice ⚠️',
                'Your post "' . \Illuminate\Support\Str::limit($report->title ?: $report->description, 30) . '" was rejected by admin.',
                null
            );
        }

        return back();
    }

    public function delete($id)
    {
        $report = Report::findOrFail($id);

        if ($report->image && file_exists(public_path('storage/' . $report->image))) {
            @unlink(public_path('storage/' . $report->image));
        }

        $report->delete();

        return redirect()->back()->with('success', 'Report deleted successfully!');
    }

    /**
     * Update an existing post.
     */
    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $this->checkBlockedUser();
        $report = Report::findOrFail($id);

        if ($report->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        $request->validate([
            'description' => 'nullable|string|max:5000',
            'location' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'video' => 'nullable|file|mimes:mp4,mov,avi,mkv,webm|max:51200',
        ]);

        if ($request->has('description')) {
            $report->description = $request->description;
        }

        if ($request->has('location')) {
            $report->location = $request->location;
        }

        // Handle image updates
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $file) {
                if ($file && $file->isValid()) {
                    $imagePaths[] = $file->store('reports', 'public');
                }
            }
            if (!empty($imagePaths)) {
                $report->images = $imagePaths;
                $report->image = $imagePaths[0];
            }
        }

        // Handle video update
        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            $report->video = $request->file('video')->store('videos', 'public');
        }

        $report->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Post updated successfully!',
            'report' => $report,
        ]);
    }

    /**
     * Delete a post (API or Form).
     */
    public function destroy(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $this->checkBlockedUser();
        $report = Report::findOrFail($id);

        if ($report->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        // Delete images & videos
        if ($report->image && file_exists(public_path('storage/' . $report->image))) {
            @unlink(public_path('storage/' . $report->image));
        }
        if (is_array($report->images)) {
            foreach ($report->images as $img) {
                if (file_exists(public_path('storage/' . $img))) {
                    @unlink(public_path('storage/' . $img));
                }
            }
        }
        if ($report->video && file_exists(public_path('storage/' . $report->video))) {
            @unlink(public_path('storage/' . $report->video));
        }

        $report->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Post deleted successfully!'
            ]);
        }

        return back()->with('success', 'Post deleted successfully!');
    }

    /**
     * Get Facebook-style Insights for a specific post.
     */
    public function getPostInsights(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $report = Report::with(['user'])->withCount(['views', 'reactions', 'comments', 'starTransactions'])->findOrFail($id);

        if ($report->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        // Followers gained from this post
        $followersGained = \App\Models\Follow::where('report_id', $id)->count();

        // Country breakdown from post_views
        $viewsByCountry = PostView::select('country', \DB::raw('count(*) as count'))
            ->where('report_id', $id)
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->get();

        $totalViews = max(1, $report->views_count);
        $countriesList = [];

        $flagMap = [
            'Bangladesh' => '🇧🇩',
            'Malaysia' => '🇲🇾',
            'United States' => '🇺🇸',
            'India' => '🇮🇳',
            'United Arab Emirates' => '🇦🇪',
            'Saudi Arabia' => '🇸🇦',
            'Qatar' => '🇶🇦',
            'United Kingdom' => '🇬🇧',
        ];

        if ($viewsByCountry->count() > 0) {
            foreach ($viewsByCountry as $v) {
                $cName = $v->country ?: 'Bangladesh';
                $pct = round(($v->count / $totalViews) * 100);
                $countriesList[] = [
                    'name' => $cName,
                    'flag' => $flagMap[$cName] ?? '🌐',
                    'count' => $v->count,
                    'percentage' => $pct,
                ];
            }
        } else {
            $countriesList[] = [
                'name' => 'Bangladesh',
                'flag' => '🇧🇩',
                'count' => $report->views_count,
                'percentage' => 100,
            ];
        }

        return response()->json([
            'status' => 'success',
            'insights' => [
                'post_id' => $report->id,
                'title' => $report->title ?: \Illuminate\Support\Str::limit($report->description, 40),
                'created_at' => $report->created_at->format('M j, Y - g:i A'),
                'views' => $report->views_count,
                'reactions' => $report->reactions_count,
                'comments' => $report->comments_count,
                'stars' => $report->star_transactions_count,
                'followers_gained' => $followersGained,
                'countries' => $countriesList,
            ]
        ]);
    }
}
