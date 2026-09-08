<?php

use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Public Reporting & Tracking Routes
Route::get('/', [ReportController::class, 'create'])->name('reports.create');
Route::post('/lapor', [ReportController::class, 'store'])->name('reports.store');
Route::get('/lapor/sukses/{code}', [ReportController::class, 'success'])->name('reports.success');

Route::get('/lacak', [ReportController::class, 'track'])->name('reports.track');
Route::post('/lacak', [ReportController::class, 'trackSearch'])->name('reports.track.search');
Route::get('/lacak/{code}', [ReportController::class, 'trackDetail'])->name('reports.track.detail');

// Education Route
Route::get('/edukasi', [EducationController::class, 'index'])->name('education.index');

// Admin / PKBM Officers Protected Routes (Requires Auth & Spatie Role/Permission)
Route::middleware(['auth', 'role:admin|officer'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/laporan/{report}', [AdminReportController::class, 'show'])->name('reports.show');
    Route::put('/laporan/{report}/status', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');
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
