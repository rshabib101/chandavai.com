<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResellerSurveyController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\StoryController;
use App\Models\User;
use App\Models\Setting;

// Public Routes
Route::get('/', [ReportController::class, 'index']);
Route::get('/referral-leaderboard', [ReferralController::class, 'index'])->name('referral.leaderboard');
Route::get('/portfolio', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/report/create', [ReportController::class, 'create']);
Route::post('/report/store', [ReportController::class, 'store']);
Route::get('/survey', [ResellerSurveyController::class, 'create']);
Route::post('/survey/store', [ResellerSurveyController::class, 'store']);
Route::post('/reseller/store', [ResellerSurveyController::class, 'store'])->name('reseller.store');

Route::get('/fifa', function () {
    return view('frontend.fifa');
});
Route::get('/cow', function () {
    return view('frontend.cow');
});
Route::get('/all', function () {
    return view('frontend.all');
});

// Authenticated User Routes (Regular Users & Admins)
Route::middleware('auth')->group(function () {
    Route::get('/user/profile/{id?}', [ProfileController::class, 'show'])->name('user.profile');
    Route::post('/user/profile/photos', [ProfileController::class, 'updatePhotos'])->name('user.profile.photos');
    Route::get('/user/analytics', [ProfileController::class, 'analytics'])->name('user.analytics');
    Route::get('/user/wallet', [ProfileController::class, 'analytics'])->name('user.wallet');
    Route::post('/user/cashout', [ProfileController::class, 'cashout'])->name('user.cashout');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/report/{id}/react', [ReportController::class, 'toggleReaction'])->name('report.react');
    Route::post('/report/{id}/comment', [ReportController::class, 'storeComment'])->name('report.comment');
    Route::post('/report/{id}/stars', [ReportController::class, 'sendStars'])->name('report.stars');
    Route::post('/report/{id}/update', [ReportController::class, 'update'])->name('report.update');
    Route::delete('/report/{id}/delete', [ReportController::class, 'destroy'])->name('report.destroy');
    Route::get('/report/{id}/insights', [ReportController::class, 'getPostInsights'])->name('report.insights');

    // Notifications Routes
    Route::get('/user/notifications', [ReportController::class, 'getNotifications'])->name('user.notifications');
    Route::post('/user/notifications/read', [ReportController::class, 'markNotificationsRead'])->name('user.notifications.read');

    // Messenger & Chat Routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/mark-read/{userId}', [ChatController::class, 'markRead'])->name('chat.mark-read');

    // 24-Hour Stories Routes
    Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
    Route::post('/story/create', [StoryController::class, 'store'])->name('story.store');

    // Follow System & Daily Challenge Routes
    Route::post('/user/{id}/follow', [ChallengeController::class, 'toggleFollow'])->name('user.follow');
    Route::get('/user/challenge-status', [ChallengeController::class, 'getStatus'])->name('user.challenge.status');
    Route::post('/user/claim-challenge', [ChallengeController::class, 'claimReward'])->name('user.challenge.claim');

    // User Client Meta Route
    Route::post('/user/update-client-meta', [ProfileController::class, 'updateClientMeta'])->name('user.client-meta');
});

// Admin Only Routes (Protected by auth and admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/users', function () {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    })->name('users');

    Route::post('/user/{id}/toggle-block', [ChallengeController::class, 'toggleBlockUser'])->name('user.toggle-block');
    Route::post('/user/{id}/toggle-role', [ChallengeController::class, 'toggleRoleUser'])->name('user.toggle-role');

    Route::get('/settings', function () {
        $minFollowers = Setting::get('min_followers_for_income', 20);
        $rewardPoints = Setting::get('daily_challenge_reward_points', 100);
        $monthlyReferralReward = Setting::get('monthly_referral_reward', 1000);
        $adScriptHead = Setting::get('ad_script_head', '');
        $adScriptFeed = Setting::get('ad_script_feed', '');
        $adScriptSidebar = Setting::get('ad_script_sidebar', '');
        $users = User::latest()->get();
        return view('admin.settings', compact(
            'minFollowers',
            'rewardPoints',
            'monthlyReferralReward',
            'adScriptHead',
            'adScriptFeed',
            'adScriptSidebar',
            'users'
        ));
    })->name('settings');

    Route::post('/settings/update', [ChallengeController::class, 'updateAdminSettings'])->name('settings.update');

    Route::get('/reports', [ReportController::class, 'admin'])->name('reports');
    Route::get('/portfolio', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::get('/report/approve/{id}', [ReportController::class, 'approve'])->name('report.approve');
    Route::get('/report/reject/{id}', [ReportController::class, 'reject'])->name('report.reject');
    Route::get('/report/delete/{id}', [ReportController::class, 'delete'])->name('report.delete');
    
    Route::get('/surveys', [ResellerSurveyController::class, 'index'])->name('surveys');
    Route::delete('/survey/{id}', [ResellerSurveyController::class, 'destroy'])->name('survey.delete');
    Route::get('/survey/{id}', [ResellerSurveyController::class, 'show'])->name('survey.show');
});

// Alias for legacy /dashboard route -> redirects to admin dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');

require __DIR__ . '/auth.php';
