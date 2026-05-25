<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Models\Report;
use App\Models\User;

Route::get('/admin/users', function () {
    $users = User::latest()->get();
    return view('admin.users', compact('users'));
});
Route::get('/', [ReportController::class, 'index']);
Route::get('/report/create', [ReportController::class, 'create']);
Route::post('/report/store', [ReportController::class, 'store']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    $reports = Report::latest()->get();
    return view('dashboard', compact('reports'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/admin/reports', [ReportController::class, 'admin']);
Route::get('/admin/report/approve/{id}', [ReportController::class, 'approve']);
Route::get('/admin/report/reject/{id}', [ReportController::class, 'reject']);





require __DIR__.'/auth.php';
