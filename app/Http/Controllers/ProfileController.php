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

        $reports = \App\Models\Report::with(['user', 'reactions', 'comments'])
            ->withCount(['views', 'starTransactions'])
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('profile.show', compact('user', 'reports', 'isOwner', 'isFollowing'));
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
        $rate = 0.025; // 1 Coin = 0.025 BDT (600 coins = 15.00 BDT)
        $totalBdt = $userPoints * $rate;

        // Calculate Today's Earnings
        $todayStars = (float) StarTransaction::where('receiver_id', $user->id)->whereDate('created_at', Carbon::today())->sum('stars');
        $todayClaimsCount = DailyChallengeClaim::where('user_id', $user->id)->whereDate('claim_date', Carbon::today())->count();
        $todayClaimsPoints = $todayClaimsCount * 100; // default daily reward points
        $todayPoints = $todayStars + $todayClaimsPoints;
        $todayBdt = $todayPoints * $rate;

        // Calculate Yesterday's Earnings
        $yesterdayStars = (float) StarTransaction::where('receiver_id', $user->id)->whereDate('created_at', Carbon::yesterday())->sum('stars');
        $yesterdayClaimsCount = DailyChallengeClaim::where('user_id', $user->id)->whereDate('claim_date', Carbon::yesterday())->count();
        $yesterdayClaimsPoints = $yesterdayClaimsCount * 100;
        $yesterdayPoints = $yesterdayStars + $yesterdayClaimsPoints;
        $yesterdayBdt = $yesterdayPoints * $rate;

        // Calculate This Month's Earnings
        $monthStars = (float) StarTransaction::where('receiver_id', $user->id)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('stars');
        $monthClaimsCount = DailyChallengeClaim::where('user_id', $user->id)->whereMonth('claim_date', Carbon::now()->month)->whereYear('claim_date', Carbon::now()->year)->count();
        $monthClaimsPoints = $monthClaimsCount * 100;
        $monthPoints = $monthStars + $monthClaimsPoints;
        if ($monthPoints < $userPoints) {
            $monthPoints = $userPoints;
        }
        $monthBdt = $monthPoints * $rate;

        // Min Cashout Info
        $minCashoutCoins = 600;
        $needsMoreCoins = max(0, $minCashoutCoins - $userPoints);

        // Fetch User's Past Withdrawals
        $withdrawals = Withdrawal::where('user_id', $user->id)->latest()->take(20)->get();

        return view('profile.analytics', compact(
            'user',
            'userPoints',
            'rate',
            'totalBdt',
            'todayPoints',
            'todayBdt',
            'yesterdayPoints',
            'yesterdayBdt',
            'monthPoints',
            'monthBdt',
            'minCashoutCoins',
            'needsMoreCoins',
            'withdrawals'
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

        if ($userPoints < $coins) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your balance is insufficient for this amount',
                'user_points' => $userPoints,
            ], 400);
        }

        $rate = 0.025;
        $amountBdt = $coins * $rate;

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
            'message' => 'Cash out request for ৳' . number_format($amountBdt, 2) . ' submitted successfully!',
            'new_points' => $user->points,
            'new_bdt' => number_format($user->points * $rate, 3),
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
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('login');
        }

        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

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

        if ($request->ajax() || $request->wantsJson()) {
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

