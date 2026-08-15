<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MicroWork;
use App\Models\MicroWorkSubmission;
use App\Models\LinkHit;
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

        $microWorks = MicroWork::withCount(['approvedSubmissions'])->where('is_active', true)->latest()->get();
        $linkHits = LinkHit::where('is_active', true)->latest()->get();

        $mySubmissions = $user 
            ? MicroWorkSubmission::with('microWork')->where('user_id', $user->id)->latest()->get()
            : collect();

        return view('tasks.index', compact('user', 'userPoints', 'microWorks', 'mySubmissions', 'linkHits'));
    }

    /**
     * Process user proof submission for a micro work task.
     */
    public function submitWorkProof(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'প্রুফ সাবমিট করতে লগইন করুন!'], 401);
        }

        $validated = $request->validate([
            'micro_work_id' => 'required|exists:micro_works,id',
            'proof_screenshot' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $work = MicroWork::withCount('approvedSubmissions')->findOrFail($validated['micro_work_id']);

        if (!$work->is_active) {
            return response()->json(['status' => 'error', 'message' => 'এই কাজটির প্রুফ জমা নেওয়া বন্ধ রয়েছে।'], 422);
        }

        if ($work->approved_submissions_count >= $work->total_slots) {
            return response()->json(['status' => 'error', 'message' => 'দুঃখিত, এই কাজের সব স্লট পূর্ণ হয়ে গেছে!'], 422);
        }

        // Check if user already submitted pending or approved proof for this task
        $existing = MicroWorkSubmission::where('micro_work_id', $work->id)
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            $msg = $existing->status === 'approved' 
                ? 'আপনি ইতিমধ্যে এই কাজটি সফলভাবে সম্পন্ন করেছেন!' 
                : 'আপনার এই কাজের প্রুফ জমা দেওয়া আছে এবং পেন্ডিং অবস্থায় রয়েছে।';
            return response()->json(['status' => 'error', 'message' => $msg], 422);
        }

        $path = $request->file('proof_screenshot')->store('proofs', 'public');

        $submission = MicroWorkSubmission::create([
            'micro_work_id' => $work->id,
            'user_id' => $user->id,
            'proof_screenshot' => $path,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => '🎉 আপনার প্রুফ সফলভাবে জমা হয়েছে! অ্যাডমিন অ্যাপ্রুভ করলেই কয়েন অ্যাকাউন্টে যোগ হবে।',
            'submission' => $submission
        ]);
    }

    /**
     * Process Math Solve 10-questions round session submission.
     */
    public function submitMathSession(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'correct_count' => 'required|integer|min:0|max:10',
        ]);

        $correct = (int)$validated['correct_count'];
        $earnedPoints = $correct * 10;

        if ($earnedPoints > 0) {
            $user->increment('points', $earnedPoints);
        }

        return response()->json([
            'status' => 'success',
            'message' => "🎉 কুইজ সম্পূর্ণ! আপনি {$correct}/10 টি সঠিক উত্তর দিয়ে {$earnedPoints} পয়েন্ট রিওয়ার্ড পেয়েছেন।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Process Typing 10-words round session submission.
     */
    public function submitTypingSession(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'correct_count' => 'required|integer|min:0|max:10',
        ]);

        $correct = (int)$validated['correct_count'];
        $earnedPoints = $correct * 10;

        if ($earnedPoints > 0) {
            $user->increment('points', $earnedPoints);
        }

        return response()->json([
            'status' => 'success',
            'message' => "⚡ টাইপিং চ্যালেঞ্জ সম্পূর্ণ! আপনি {$correct}/10 টি সঠিক শব্দ টাইপ করে {$earnedPoints} পয়েন্ট রিওয়ার্ড পেয়েছেন।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Legacy Math Solve handler.
     */
    public function submitMath(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $earnedPoints = 10;
        $user->increment('points', $earnedPoints);

        return response()->json([
            'status' => 'success',
            'message' => "🎉 সঠিক উত্তর! আপনি $earnedPoints পয়েন্ট রিওয়ার্ড পেয়েছেন।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Legacy Typing handler.
     */
    public function submitTyping(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $earnedPoints = 10;
        $user->increment('points', $earnedPoints);

        return response()->json([
            'status' => 'success',
            'message' => "⚡ টাইপিং সম্পূর্ণ! আপনি $earnedPoints পয়েন্ট রিওয়ার্ড পেয়েছেন।",
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

        $earnedPoints = $request->input('reward', 20);
        $user->increment('points', $earnedPoints);

        return response()->json([
            'status' => 'success',
            'message' => "🌐 লিংক ভিজিট সফল! আপনি $earnedPoints পয়েন্ট রিওয়ার্ড পেয়েছেন।",
            'earned_points' => $earnedPoints,
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Legacy Works task handler.
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
