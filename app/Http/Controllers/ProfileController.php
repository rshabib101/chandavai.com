<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Withdrawal;
use App\Models\StarTransaction;
use App\Models\DailyChallengeClaim;
use App\Models\MicroWorkSubmission;
use App\Models\Setting;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the Facebook/Boipai style user profile view.
     */
    public function show(Request $request, $id = null)
    {
        if ($id) {
            $user = \App\Models\User::findOrFail($id);
        } else {
            $user = $request->user();
        }

        if (!$user) {
            return redirect()->route('login');
        }

        $isOwner = auth()->check() && (auth()->id() == $user->id);
        $isFollowing = auth()->check() ? auth()->user()->isFollowing($user->id) : false;

        $followersCount = \App\Models\Follow::where('following_id', $user->id)->count();
        $followingCount = \App\Models\Follow::where('follower_id', $user->id)->count();
        $followersList = \App\Models\Follow::with('follower')
            ->where('following_id', $user->id)
            ->latest()
            ->take(8)
            ->get()
            ->pluck('follower')
            ->filter();

        $reports = \App\Models\Report::with(['user', 'reactions', 'comments'])
            ->withCount(['views', 'starTransactions'])
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('profile.show', compact('user', 'reports', 'isOwner', 'isFollowing', 'followersCount', 'followingCount', 'followersList'));
    }

    /**
     * Update user personal information.
     */
    public function updateInfo(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:30',
            'whatsapp' => 'nullable|string|max:30',
            'hometown' => 'nullable|string|max:100',
            'work' => 'nullable|string|max:200',
            'education' => 'nullable|string|max:200',
            'relationship_status' => 'nullable|string|max:50',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|string|max:30',
        ]);

        $user->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile information updated successfully!',
            'user' => $user
        ]);
    }

    /**
     * Display the settings view.
     */
    public function settings(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        return view('profile.settings', compact('user'));
    }

    /**
     * Display the Wallet & Cash Out Earning Dashboard.
     */
    public function analytics(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $userPoints = (float) ($user->points ?? 0);

        // Dynamic rate: coins_per_taka (Default: 40 coins = 1 BDT)
        $coinsPerTaka = (float) Setting::get('coins_per_taka', 40);
        if ($coinsPerTaka <= 0) {
            $coinsPerTaka = 40;
        }

        $minCashoutCoins = (int) Setting::get('min_cashout_coins', 600);
        $totalBdt = $userPoints / $coinsPerTaka;

        $rewardPointsSetting = (int) Setting::get('daily_challenge_reward_points', 100);

        // Calculate Today's Earnings
        $todayWorkCoins = (float) MicroWorkSubmission::where('micro_work_submissions.user_id', $user->id)
            ->where('micro_work_submissions.status', 'approved')
            ->whereDate('micro_work_submissions.updated_at', Carbon::today())
            ->join('micro_works', 'micro_work_submissions.micro_work_id', '=', 'micro_works.id')
            ->sum('micro_works.reward_coins');

        $todayStars = (float) StarTransaction::where('receiver_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->sum('stars');

        $todayClaimsCount = DailyChallengeClaim::where('user_id', $user->id)
            ->whereDate('claim_date', Carbon::today())
            ->count();

        $todayPoints = $todayWorkCoins + $todayStars + ($todayClaimsCount * $rewardPointsSetting);
        $todayBdt = $todayPoints / $coinsPerTaka;

        // Calculate Yesterday's Earnings
        $yesterdayWorkCoins = (float) MicroWorkSubmission::where('micro_work_submissions.user_id', $user->id)
            ->where('micro_work_submissions.status', 'approved')
            ->whereDate('micro_work_submissions.updated_at', Carbon::yesterday())
            ->join('micro_works', 'micro_work_submissions.micro_work_id', '=', 'micro_works.id')
            ->sum('micro_works.reward_coins');

        $yesterdayStars = (float) StarTransaction::where('receiver_id', $user->id)
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('stars');

        $yesterdayClaimsCount = DailyChallengeClaim::where('user_id', $user->id)
            ->whereDate('claim_date', Carbon::yesterday())
            ->count();

        $yesterdayPoints = $yesterdayWorkCoins + $yesterdayStars + ($yesterdayClaimsCount * $rewardPointsSetting);
        $yesterdayBdt = $yesterdayPoints / $coinsPerTaka;

        // Calculate This Month's Earnings
        $monthWorkCoins = (float) MicroWorkSubmission::where('micro_work_submissions.user_id', $user->id)
            ->where('micro_work_submissions.status', 'approved')
            ->whereMonth('micro_work_submissions.updated_at', Carbon::now()->month)
            ->whereYear('micro_work_submissions.updated_at', Carbon::now()->year)
            ->join('micro_works', 'micro_work_submissions.micro_work_id', '=', 'micro_works.id')
            ->sum('micro_works.reward_coins');

        $monthStars = (float) StarTransaction::where('receiver_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('stars');

        $monthClaimsCount = DailyChallengeClaim::where('user_id', $user->id)
            ->whereMonth('claim_date', Carbon::now()->month)
            ->whereYear('claim_date', Carbon::now()->year)
            ->count();

        $monthPoints = $monthWorkCoins + $monthStars + ($monthClaimsCount * $rewardPointsSetting);
        if ($monthPoints < $userPoints) {
            $monthPoints = $userPoints;
        }
        $monthBdt = $monthPoints / $coinsPerTaka;

        // Min Cashout Info
        $needsMoreCoins = max(0, $minCashoutCoins - $userPoints);

        // Fetch User's Past Withdrawals
        $withdrawals = Withdrawal::where('user_id', $user->id)->latest()->take(20)->get();
        $userAds = \App\Models\SponsoredAd::where('user_id', $user->id)->latest()->get();

        return view('profile.analytics', compact(
            'user',
            'userPoints',
            'coinsPerTaka',
            'totalBdt',
            'todayPoints',
            'todayBdt',
            'yesterdayPoints',
            'yesterdayBdt',
            'monthPoints',
            'monthBdt',
            'minCashoutCoins',
            'needsMoreCoins',
            'withdrawals',
            'userAds'
        ));
    }

    /**
     * Handle Cash Out Withdrawal Submission.
     */
    public function cashout(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $request->validate([
            'coins' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'account_number' => 'required|string|min:4|max:50',
        ]);

        $coins = (float) $request->coins;
        $userPoints = (float) $user->points;

        $coinsPerTaka = (float) Setting::get('coins_per_taka', 40);
        if ($coinsPerTaka <= 0) {
            $coinsPerTaka = 40;
        }

        if ($userPoints < $coins) {
            return response()->json([
                'status' => 'error',
                'message' => 'পর্যাপ্ত ব্যালেন্স নেই! আপনার বর্তমান ব্যালেন্স: ' . number_format($userPoints, 1) . ' কয়েন।',
                'user_points' => $userPoints,
            ], 400);
        }

        $amountBdt = $coins / $coinsPerTaka;

        // Deduct points
        $user->points = max(0, $userPoints - $coins);
        $user->save();

        // Create Withdrawal record
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'coins' => $coins,
            'amount_bdt' => $amountBdt,
            'payment_method' => $request->payment_method,
            'account_number' => $request->account_number,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => '🎉 ৳' . number_format($amountBdt, 2) . ' টাকা উইথড্রল রিকোয়েস্ট জমা হয়েছে! অ্যাডমিন ভেরিফাই করে পেমেন্ট পাঠিয়ে দেবেন।',
            'new_points' => $user->points,
            'new_bdt' => number_format($user->points / $coinsPerTaka, 2),
            'withdrawal' => $withdrawal,
        ]);
    }



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update user profile photo and/or cover photo.
     */
    public function updatePhotos(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('login');
        }

        try {
            $request->validate([
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,heic|max:10240',
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,heic|max:10240',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => collect($e->errors())->flatten()->first() ?? 'Invalid image file.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        $updated = false;

        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            if ($user->profile_photo && file_exists(public_path('storage/' . $user->profile_photo))) {
                @unlink(public_path('storage/' . $user->profile_photo));
            }
            $user->profile_photo = $request->file('profile_photo')->store('profiles', 'public');
            $updated = true;
        }

        if ($request->hasFile('cover_photo') && $request->file('cover_photo')->isValid()) {
            if ($user->cover_photo && file_exists(public_path('storage/' . $user->cover_photo))) {
                @unlink(public_path('storage/' . $user->cover_photo));
            }
            $user->cover_photo = $request->file('cover_photo')->store('covers', 'public');
            $updated = true;
        }

        if ($updated) {
            $user->save();
        }

        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'ছবি সফলভাবে আপডেট করা হয়েছে!',
                'profile_photo_url' => $user->profile_photo_url,
                'cover_photo_url' => $user->cover_photo_url,
            ]);
        }

        return back()->with('success', 'Photo updated successfully!');
    }

    /**
     * Update client-side screen resolution & timezone metadata.
     */
    public function updateClientMeta(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $data = [];
            if ($request->filled('screen_resolution')) {
                $data['screen_resolution'] = substr($request->input('screen_resolution'), 0, 50);
            }
            if ($request->filled('timezone')) {
                $data['timezone'] = substr($request->input('timezone'), 0, 100);
            }
            if (!empty($data)) {
                $user->update($data);
            }
        }
        return response()->json(['status' => 'success']);
    }
}

