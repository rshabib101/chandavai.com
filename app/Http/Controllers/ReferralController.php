<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Fetch top referrers in current month
        $monthlyLeaderboard = User::whereHas('referrals', function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear);
        })
        ->withCount(['referrals as monthly_referrals_count' => function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear);
        }])
        ->orderBy('monthly_referrals_count', 'desc')
        ->take(20)
        ->get();

        // Fetch overall top referrers
        $overallLeaderboard = User::has('referrals')
            ->withCount('referrals')
            ->orderBy('referrals_count', 'desc')
            ->take(10)
            ->get();

        $rewardAmount = Setting::get('monthly_referral_reward', 1000);

        $currentUser = auth()->user();
        if ($currentUser && empty($currentUser->referral_code)) {
            $currentUser->referral_code = User::generateUniqueReferralCode();
            $currentUser->save();
        }

        return view('referral.leaderboard', compact(
            'monthlyLeaderboard',
            'overallLeaderboard',
            'rewardAmount',
            'currentUser'
        ));
    }
}
