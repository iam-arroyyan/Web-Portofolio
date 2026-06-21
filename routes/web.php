<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/comment', [HomeController::class, 'storeComment'])->name('comment.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // CRUD Routes
        Route::resource('portfolio', \App\Http\Controllers\Admin\PortfolioController::class);
        Route::resource('certifications', \App\Http\Controllers\Admin\CertificationController::class);
        Route::resource('achievements', \App\Http\Controllers\Admin\AchievementController::class);
        Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class)->except(['show', 'edit', 'update']);
        Route::resource('music', \App\Http\Controllers\Admin\MusicTrackController::class)->except(['show']);
        Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->except(['show']);
        Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class)->only(['index', 'destroy']);
        
        // Settings
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
