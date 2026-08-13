<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TaskHubController extends Controller
{
    /**
     * Display the Tasks Hub page with 4 task categories: Works, Math Solve, Typing, Link Hits.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $userPoints = $user ? ($user->points ?? 0) : 0;

        return view('tasks.index', compact('user', 'userPoints'));
    }

    /**
     * Process Math Solve task submission.
     */
    public function submitMath(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'num1' => 'required|integer',
            'num2' => 'required|integer',
            'operator' => 'required|string',
            'user_answer' => 'required|integer',
        ]);

        $num1 = $validated['num1'];
        $num2 = $validated['num2'];
        $operator = $validated['operator'];
        $expected = 0;

        if ($operator === '+') {
            $expected = $num1 + $num2;
        } elseif ($operator === '-') {
            $expected = $num1 - $num2;
        } elseif ($operator === '×' || $operator === '*') {
            $expected = $num1 * $num2;
        }

        if ((int)$validated['user_answer'] !== (int)$expected) {
            return response()->json([
                'status' => 'error',
                'message' => "❌ ভুল উত্তর! সঠিক উত্তর ছিল: $expected। আবার চেষ্টা করুন।"
            ], 422);
        }

        $earnedPoints = 15;
        $user->increment('points', $earnedPoints);

        return response()->json([
            'status' => 'success',
            'message' => "🎉 সঠিক উত্তর! আপনি $earnedPoints পয়েন্ট রিওয়ার্ড পেয়েছেন।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Process Typing task submission.
     */
    public function submitTyping(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'target_text' => 'required|string',
            'typed_text' => 'required|string',
        ]);

        $target = trim(preg_replace('/\s+/', ' ', $validated['target_text']));
        $typed = trim(preg_replace('/\s+/', ' ', $validated['typed_text']));

        if (mb_strtolower($target) !== mb_strtolower($typed)) {
            return response()->json([
                'status' => 'error',
                'message' => '❌ টাইপিং সম্পূর্ণ নির্ভুল হয়নি! সব শব্দ মিলিয়ে আবার চেষ্টা করুন।'
            ], 422);
        }

        $earnedPoints = 25;
        $user->increment('points', $earnedPoints);

        return response()->json([
            'status' => 'success',
            'message' => "⚡ অসাধারণ স্পিড! আপনি $earnedPoints পয়েন্ট রিওয়ার্ড পেয়েছেন।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Process Link Hit completion.
     */
    public function submitLinkHit(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $earnedPoints = 20;
        $user->increment('points', $earnedPoints);

        return response()->json([
            'status' => 'success',
            'message' => "🌐 লিংক ভিজিট সফল! আপনি $earnedPoints পয়েন্ট রিওয়ার্ড পেয়েছেন।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Process Works task completion.
     */
    public function submitWork(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'work_title' => 'required|string',
            'reward' => 'required|integer|min:5|max:500',
        ]);

        $earnedPoints = (int)$validated['reward'];
        $user->increment('points', $earnedPoints);

        return response()->json([
            'status' => 'success',
            'message' => "💼 '" . $validated['work_title'] . "' কাজ সম্পূর্ণ হয়েছে! $earnedPoints পয়েন্ট যোগ হয়েছে।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }
}
