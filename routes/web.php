<?php

use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Public Reporting & Tracking Routes
Route::get('/', [ReportController::class, 'create'])->name('reports.create');
Route::post('/lapor', [ReportController::class, 'store'])->name('reports.store');
Route::get('/lapor/sukses/{code}', [ReportController::class, 'success'])->name('reports.success');

Route::redirect('/login', '/admin/login');

Route::get('/lacak', [ReportController::class, 'track'])->name('reports.track');
Route::post('/lacak', [ReportController::class, 'trackSearch'])->name('reports.track.search');
Route::get('/lacak/{code}', [ReportController::class, 'trackDetail'])->name('reports.track.detail');

// Education Route
Route::get('/edukasi', [EducationController::class, 'index'])->name('education.index');

// Admin & Super Admin Protected Routes
Route::middleware(['auth', 'role:super_admin|admin'])->prefix('admin')->name('admin.')->group(function () {
    // Report Management Routes (Accessible by super_admin & admin)
    Route::get('/', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/laporan/{report}', [AdminReportController::class, 'show'])->name('reports.show');
    Route::put('/laporan/{report}/status', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');

    // Super Admin Account Management & Monitoring Routes (Accessible ONLY by super_admin)
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});

// User Profile Routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.reports.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
