<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $stories = Story::with('user')
            ->where('expires_at', '>', now())
            ->latest()
            ->get();

        $formatted = [];
        foreach ($stories as $s) {
            $formatted[] = [
                'id' => $s->id,
                'user_id' => $s->user_id,
                'user_name' => $s->user->name ?? 'User',
                'user_avatar' => $s->user->profile_photo_url,
                'user_initial' => strtoupper(substr($s->user->name ?? 'U', 0, 1)),
                'image_url' => $s->image_url,
                'caption' => $s->caption,
                'created_at' => $s->created_at->diffForHumans(),
            ];
        }

        return response()->json([
            'status' => 'success',
            'stories' => $formatted,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'caption' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('stories', 'public');

            $story = Story::create([
                'user_id' => $user->id,
                'image' => $path,
                'caption' => $request->caption,
                'expires_at' => now()->addHours(24),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Story shared successfully!',
                'story' => [
                    'id' => $story->id,
                    'user_id' => $story->user_id,
                    'user_name' => $user->name,
                    'user_avatar' => $user->profile_photo_url,
                    'user_initial' => strtoupper(substr($user->name ?? 'U', 0, 1)),
                    'image_url' => $story->image_url,
                    'caption' => $story->caption,
                    'created_at' => $story->created_at->diffForHumans(),
                ]
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Failed to upload story image.'], 400);
    }
}
