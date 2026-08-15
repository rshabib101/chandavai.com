<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MicroWork;
use App\Models\MicroWorkSubmission;
use App\Models\LinkHit;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTaskController extends Controller
{
    /**
     * Display Work Tasks management & Submissions list page.
     */
    public function workIndex(Request $request)
    {
        $works = MicroWork::withCount(['submissions', 'approvedSubmissions'])->latest()->get();

        $statusFilter = $request->query('status');
        $submissionsQuery = MicroWorkSubmission::with(['microWork', 'user'])->latest();

        if ($statusFilter && in_array($statusFilter, ['pending', 'approved', 'rejected'])) {
            $submissionsQuery->where('status', $statusFilter);
        }

        $submissions = $submissionsQuery->get();

        $pendingCount = MicroWorkSubmission::where('status', 'pending')->count();
        $approvedCount = MicroWorkSubmission::where('status', 'approved')->count();
        $rejectedCount = MicroWorkSubmission::where('status', 'rejected')->count();

        return view('admin.tasks.work', compact('works', 'submissions', 'statusFilter', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    /**
     * Store a new Micro Work task.
     */
    public function workStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'reward_coins' => 'required|integer|min:1',
            'total_slots' => 'required|integer|min:1',
            'task_link' => 'nullable|url|max:500',
            'instruction' => 'nullable|string',
            'demo_screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'required_proofs_count' => 'required|integer|min:1|max:5',
        ]);

        if ($request->hasFile('demo_screenshot')) {
            $path = $request->file('demo_screenshot')->store('works_demo', 'public');
            $validated['demo_screenshot'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        MicroWork::create($validated);

        return redirect()->route('admin.tasks.work')->with('success', 'নতুন ওয়ার্ক টাস্ক সফলভাবে যুক্ত করা হয়েছে!');
    }

    /**
     * Update an existing Micro Work task.
     */
    public function workUpdate(Request $request, $id)
    {
        $work = MicroWork::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'reward_coins' => 'required|integer|min:1',
            'total_slots' => 'required|integer|min:1',
            'task_link' => 'nullable|url|max:500',
            'instruction' => 'nullable|string',
            'demo_screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'required_proofs_count' => 'required|integer|min:1|max:5',
        ]);

        if ($request->hasFile('demo_screenshot')) {
            if ($work->demo_screenshot && Storage::disk('public')->exists($work->demo_screenshot)) {
                Storage::disk('public')->delete($work->demo_screenshot);
            }
            $path = $request->file('demo_screenshot')->store('works_demo', 'public');
            $validated['demo_screenshot'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        $work->update($validated);

        return redirect()->route('admin.tasks.work')->with('success', 'ওয়ার্ক টাস্ক সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Delete a Micro Work task.
     */
    public function workDestroy($id)
    {
        $work = MicroWork::findOrFail($id);
        if ($work->demo_screenshot && Storage::disk('public')->exists($work->demo_screenshot)) {
            Storage::disk('public')->delete($work->demo_screenshot);
        }
        $work->delete();

        return redirect()->route('admin.tasks.work')->with('success', 'টাস্কটি ডিলিট করা হয়েছে।');
    }

    /**
     * Toggle Micro Work active status.
     */
    public function workToggle($id)
    {
        $work = MicroWork::findOrFail($id);
        $work->is_active = !$work->is_active;
        $work->save();

        return redirect()->route('admin.tasks.work')->with('success', 'টাস্ক স্ট্যাটাস পরিবর্তন করা হয়েছে।');
    }

    /**
     * Approve user submission and reward coins.
     */
    public function submissionApprove($id)
    {
        $submission = MicroWorkSubmission::with(['user', 'microWork'])->findOrFail($id);

        if ($submission->status === 'approved') {
            return redirect()->back()->with('info', 'এই সাবমিশনটি ইতিমধ্যে অনুমোদিত হয়েছে।');
        }

        $submission->status = 'approved';
        $submission->save();

        // Increment user reward coins
        $user = $submission->user;
        $rewardCoins = $submission->microWork ? $submission->microWork->reward_coins : 0;
        if ($user && $rewardCoins > 0) {
            $user->increment('points', $rewardCoins);
        }

        // Send Notification to user
        if ($user && $submission->microWork) {
            UserNotification::createNotification(
                $user->id,
                auth()->id(),
                'task_approved',
                'টাস্ক অনুমোদিত হয়েছে! 🎉',
                "আপনার '" . $submission->microWork->title . "' প্রুফটি অনুমোদিত হয়েছে এবং {$rewardCoins} কয়েন পয়েন্ট যোগ হয়েছে।",
                '/tasks'
            );
        }

        return redirect()->back()->with('success', "সাবমিশন অনুমোদিত হয়েছে! ইউজারকে {$rewardCoins} কয়েন প্রদান করা হয়েছে।");
    }

    /**
     * Reject user submission.
     */
    public function submissionReject(Request $request, $id)
    {
        $submission = MicroWorkSubmission::with(['user', 'microWork'])->findOrFail($id);

        $reason = $request->input('rejection_reason', 'প্রুফ সঠিক নয় বা অসম্পূর্ণ।');
        $submission->status = 'rejected';
        $submission->rejection_reason = $reason;
        $submission->save();

        // Send Notification to user
        $user = $submission->user;
        if ($user && $submission->microWork) {
            UserNotification::createNotification(
                $user->id,
                auth()->id(),
                'task_rejected',
                'টাস্ক সাবমিশন বাতিল করা হয়েছে',
                "আপনার '" . $submission->microWork->title . "' কাজ প্রুফটি রিজেক্ট করা হয়েছে। কারণ: {$reason}",
                '/tasks'
            );
        }

        return redirect()->back()->with('success', 'সাবমিশন রিজেক্ট করা হয়েছে।');
    }

    /**
     * Display Link Hits management page.
     */
    public function linkHitsIndex()
    {
        $linkHits = LinkHit::latest()->get();
        return view('admin.tasks.link-hits', compact('linkHits'));
    }

    /**
     * Store a new Link Hit.
     */
    public function linkHitsStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'reward_points' => 'required|integer|min:1',
            'timer_seconds' => 'required|integer|min:1|max:120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        LinkHit::create($validated);

        return redirect()->route('admin.tasks.link-hits')->with('success', 'নতুন লিংক হিট সফলভাবে তৈরি হয়েছে!');
    }

    /**
     * Update an existing Link Hit.
     */
    public function linkHitsUpdate(Request $request, $id)
    {
        $linkHit = LinkHit::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'reward_points' => 'required|integer|min:1',
            'timer_seconds' => 'required|integer|min:1|max:120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $linkHit->update($validated);

        return redirect()->route('admin.tasks.link-hits')->with('success', 'লিংক হিট সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Delete a Link Hit.
     */
    public function linkHitsDestroy($id)
    {
        $linkHit = LinkHit::findOrFail($id);
        $linkHit->delete();

        return redirect()->route('admin.tasks.link-hits')->with('success', 'লিংক হিটটি মুছে ফেলা হয়েছে।');
    }

    /**
     * Toggle Link Hit active status.
     */
    public function linkHitsToggle($id)
    {
        $linkHit = LinkHit::findOrFail($id);
        $linkHit->is_active = !$linkHit->is_active;
        $linkHit->save();

        return redirect()->route('admin.tasks.link-hits')->with('success', 'লিংক হিট স্ট্যাটাস পরিবর্তন করা হয়েছে।');
    }
}
