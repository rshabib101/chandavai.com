<?php

namespace App\Http\Controllers;

use App\Models\DailyChallengeClaim;
use App\Models\Follow;
use App\Models\Reaction;
use App\Models\Report;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * Fetch current user's Daily Challenge status & Monetization status.
     */
    public function getStatus(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $today = now()->toDateString();

        // 1. Calculate Daily Challenge Progress
        $postsToday = Report::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        $followersTotal = $user->followers_count;
        $followingTotal = $user->following_count;

        $likesToday = Reaction::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        $targetPosts = 3;
        $targetFollowers = 10;
        $targetFollowing = 20;
        $targetLikes = 100;

        $postsCompleted = min($postsToday, $targetPosts);
        $followersCompleted = min($followersTotal, $targetFollowers);
        $followingCompleted = min($followingTotal, $targetFollowing);
        $likesCompleted = min($likesToday, $targetLikes);

        $isCompleted = ($postsToday >= $targetPosts) &&
                       ($followersTotal >= $targetFollowers) &&
                       ($followingTotal >= $targetFollowing) &&
                       ($likesToday >= $targetLikes);

        $isClaimed = DailyChallengeClaim::where('user_id', $user->id)
            ->where('claim_date', $today)
            ->exists();

        $rewardPoints = (int) Setting::get('daily_challenge_reward_points', 100);

        // 2. Calculate Income Monetization Progress
        $monetizationInfo = $user->checkMonetizationEligibility();

        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'points' => $user->points,
                'is_monetized' => $user->is_monetized,
            ],
            'challenge' => [
                'reward_points' => $rewardPoints,
                'is_completed' => $isCompleted,
                'is_claimed' => $isClaimed,
                'tasks' => [
                    'posts' => [
                        'current' => $postsToday,
                        'target' => $targetPosts,
                        'done' => $postsToday >= $targetPosts,
                    ],
                    'followers' => [
                        'current' => $followersTotal,
                        'target' => $targetFollowers,
                        'done' => $followersTotal >= $targetFollowers,
                    ],
                    'following' => [
                        'current' => $followingTotal,
                        'target' => $targetFollowing,
                        'done' => $followingTotal >= $targetFollowing,
                    ],
                    'likes' => [
                        'current' => $likesToday,
                        'target' => $targetLikes,
                        'done' => $likesToday >= $targetLikes,
                    ],
                ]
            ],
            'monetization' => $monetizationInfo
        ]);
    }

    /**
     * Claim Daily Challenge 100 Points Reward.
     */
    public function claimReward(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $today = now()->toDateString();

        // Check if already claimed today
        $alreadyClaimed = DailyChallengeClaim::where('user_id', $user->id)
            ->where('claim_date', $today)
            ->exists();

        if ($alreadyClaimed) {
            return response()->json([
                'status' => 'error',
                'message' => 'আপনি আজকের ১০০ পয়েন্ট রিওয়ার্ড আগেই দাবি করেছেন!'
            ], 400);
        }

        // Verify task completion
        $postsToday = Report::where('user_id', $user->id)->whereDate('created_at', $today)->count();
        $followersTotal = $user->followers_count;
        $followingTotal = $user->following_count;
        $likesToday = Reaction::where('user_id', $user->id)->whereDate('created_at', $today)->count();

        if ($postsToday < 3 || $followersTotal < 10 || $followingTotal < 20 || $likesToday < 100) {
            return response()->json([
                'status' => 'error',
                'message' => 'আজকের চ্যালেঞ্জ এখনো সম্পূর্ণ হয়নি! ৪টি টাস্কই পূরণ করুন।'
            ], 400);
        }

        $rewardPoints = (int) Setting::get('daily_challenge_reward_points', 100);

        // Record claim and add points
        DailyChallengeClaim::create([
            'user_id' => $user->id,
            'claim_date' => $today,
            'reward_points' => $rewardPoints,
        ]);

        $user->increment('points', $rewardPoints);

        return response()->json([
            'status' => 'success',
            'message' => 'অভিনন্দন! আপনি ১০০ পয়েন্ট রিওয়ার্ড পেয়েছেন 🎉',
            'new_points' => $user->fresh()->points
        ]);
    }

    /**
     * Toggle Follow / Unfollow a user.
     */
    public function toggleFollow(Request $request, $id)
    {
        $authUser = auth()->user();
        if (!$authUser) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        if ($authUser->id == $id) {
            return response()->json(['status' => 'error', 'message' => 'You cannot follow yourself'], 400);
        }

        $targetUser = User::findOrFail($id);

        $existing = Follow::where('follower_id', $authUser->id)
            ->where('following_id', $targetUser->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $isFollowing = false;
        } else {
            Follow::create([
                'follower_id' => $authUser->id,
                'following_id' => $targetUser->id,
                'report_id' => $request->report_id ?: null,
            ]);
            $isFollowing = true;

            // Send notification to target user
            \App\Models\UserNotification::createNotification(
                $targetUser->id,
                $authUser->id,
                'follow',
                'New Follower 👤',
                $authUser->name . ' started following you!',
                '/#user-profile'
            );
        }

        // Re-evaluate monetization eligibility for target user
        $targetMonetization = $targetUser->checkMonetizationEligibility();

        return response()->json([
            'status' => 'success',
            'is_following' => $isFollowing,
            'target_user_id' => $targetUser->id,
            'followers_count' => $targetUser->fresh()->followers_count,
            'target_monetized' => $targetMonetization['eligible'],
        ]);
    }

    /**
     * Admin Panel: Toggle Block / Unblock User.
     */
    public function toggleBlockUser(Request $request, $id)
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        if (!$currentUser || !$currentUser->isCreatorAdmin()) {
            return redirect()->back()->with('error', 'Only Creator Admin can block or unblock users.');
        }

        $user = User::findOrFail($id);
        if ($user->id == $currentUser->id) {
            return redirect()->back()->with('error', 'You cannot block yourself.');
        }

        $user->is_blocked = !$user->is_blocked;
        $user->save();

        $statusMsg = $user->is_blocked ? 'blocked' : 'unblocked';

        return redirect()->back()->with('success', "User {$user->name} has been {$statusMsg}!");
    }

    /**
     * Admin Panel: Update Monetization Settings.
     */
    public function updateAdminSettings(Request $request)
    {
        $request->validate([
            'coins_per_taka' => 'required|numeric|min:0.1',
            'min_cashout_coins' => 'required|integer|min:1',
            'min_followers_for_income' => 'required|integer|min:1',
            'daily_challenge_reward_points' => 'nullable|integer|min:1',
            'monthly_referral_reward' => 'nullable|integer|min:0',
        ]);

        Setting::set('coins_per_taka', $request->coins_per_taka);
        Setting::set('min_cashout_coins', $request->min_cashout_coins);
        Setting::set('min_followers_for_income', $request->min_followers_for_income);
        
        if ($request->has('daily_challenge_reward_points')) {
            Setting::set('daily_challenge_reward_points', $request->daily_challenge_reward_points);
        }

        if ($request->has('monthly_referral_reward')) {
            Setting::set('monthly_referral_reward', $request->monthly_referral_reward);
        }

        // Update all users monetization status based on new threshold
        $minFollowers = (int) $request->min_followers_for_income;
        $users = User::all();
        foreach ($users as $u) {
            $u->checkMonetizationEligibility();
        }

        return redirect()->back()->with('success', 'Admin settings updated successfully!');
    }

    /**
     * Admin Panel: Update AmarFeed Ad Scripts & Entrance Popup Ad.
     */
    public function updateAmarFeedAds(Request $request)
    {
        $request->validate([
            'ad_script_head' => 'nullable|string',
            'ad_script_feed' => 'nullable|string',
            'ad_script_sidebar' => 'nullable|string',
            'popup_ad_enabled' => 'nullable|string',
            'popup_ad_image' => 'nullable|string',
            'popup_ad_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'popup_ad_headline' => 'nullable|string|max:500',
            'popup_ad_button_text' => 'nullable|string|max:100',
            'popup_ad_button_link' => 'nullable|string|max:1000',
        ]);

        Setting::set('ad_script_head', $request->ad_script_head ?? '');
        Setting::set('ad_script_feed', $request->ad_script_feed ?? '');
        Setting::set('ad_script_sidebar', $request->ad_script_sidebar ?? '');

        // Website Entrance Popup Ad Settings
        Setting::set('popup_ad_enabled', $request->has('popup_ad_enabled') ? '1' : '0');
        Setting::set('popup_ad_headline', $request->popup_ad_headline ?? '');
        Setting::set('popup_ad_button_text', $request->popup_ad_button_text ?? '');
        Setting::set('popup_ad_button_link', $request->popup_ad_button_link ?? '');

        if ($request->hasFile('popup_ad_image_file') && $request->file('popup_ad_image_file')->isValid()) {
            $path = $request->file('popup_ad_image_file')->store('popup_ads', 'public');
            Setting::set('popup_ad_image', $path);
        } elseif ($request->filled('popup_ad_image')) {
            Setting::set('popup_ad_image', $request->popup_ad_image);
        }

        return redirect()->back()->with('success', 'AmarFeed Ad scripts and Entrance Popup Ad updated successfully!');
    }

    /**
     * Admin Panel: Toggle User Role (User / Admin / Creator Admin).
     */
    public function toggleRoleUser(Request $request, $id)
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        if (!$currentUser || !$currentUser->isCreatorAdmin()) {
            return redirect()->back()->with('error', 'Only Creator Admin can change user roles.');
        }

        $user = User::findOrFail($id);
        if ($user->id == $currentUser->id) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        if ($request->has('role') && in_array($request->input('role'), ['user', 'advertiser', 'admin', 'creator_admin'])) {
            $user->role = $request->input('role');
        } else {
            // Cycle role: user -> advertiser -> admin -> creator_admin -> user
            if ($user->role === 'user' || empty($user->role)) {
                $user->role = 'advertiser';
            } elseif ($user->role === 'advertiser') {
                $user->role = 'admin';
            } elseif ($user->role === 'admin') {
                $user->role = 'creator_admin';
            } else {
                $user->role = 'user';
            }
        }
        $user->save();

        return redirect()->back()->with('success', "User {$user->name} role updated to {$user->role}!");
    }
}
