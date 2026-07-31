<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PortfolioController;

use App\Models\User;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResellerSurveyController;

Route::get('/admin/users', function () {
    $users = User::latest()->get();
    return view('admin.users', compact('users'));
});
Route::get('/', [ReportController::class, 'index']);
Route::get('/portfolio', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/report/create', [ReportController::class, 'create']);
Route::post('/report/store', [ReportController::class, 'store']);
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/survey', [ResellerSurveyController::class, 'create']);
Route::post('/survey/store', [ResellerSurveyController::class, 'store']);

Route::post('/reseller/store', [ResellerSurveyController::class, 'store'])->name('reseller.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::get('/user/analytics', [ProfileController::class, 'analytics'])->name('user.analytics');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/report/{id}/react', [ReportController::class, 'toggleReaction'])->name('report.react');
    Route::post('/report/{id}/comment', [ReportController::class, 'storeComment'])->name('report.comment');

    Route::get('/admin/reports', [ReportController::class, 'admin']);
    Route::get('/admin/portfolio', [PortfolioController::class, 'edit'])->name('admin.portfolio.edit');
    Route::put('/admin/portfolio', [PortfolioController::class, 'update'])->name('admin.portfolio.update');
    Route::get('/admin/report/approve/{id}', [ReportController::class, 'approve']);
    Route::get('/admin/report/reject/{id}', [ReportController::class, 'reject']);
    Route::get('/admin/report/delete/{id}', [ReportController::class, 'delete']);
    Route::get('/admin/surveys', [ResellerSurveyController::class, 'index']);
    Route::get('/admin/surveys', [ResellerSurveyController::class, 'index'])->name('admin.surveys');

    Route::delete('/admin/survey/{id}', [ResellerSurveyController::class, 'destroy'])
        ->name('survey.delete');

    Route::get('/admin/survey/{id}', [ResellerSurveyController::class, 'show'])
        ->name('survey.show');
});












Route::get('/fifa', function () {
    return view('frontend.fifa');
});
Route::get('/cow', function () {
    return view('frontend.cow');
});
Route::get('/all', function () {
    return view('frontend.all');
});




require __DIR__ . '/auth.php';
