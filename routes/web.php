<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Admin Auth Routes
Route::prefix('admin')->group(function () {
    // Login Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Protected Admin Routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/chat' , [AdminDashboardController::class , 'groupChat'])->name('admin.group.chat');

        // add new user and list --
        Route::get('/add-user',[AdminDashboardController::class , 'addUser'])->name('admin.add.user');
        Route::post('/add-user',[AdminDashboardController::class , 'addUserStore'])->name('admin.add.user.store');
        Route::get('/user-list',[AdminDashboardController::class ,'usersList'] )->name('admin.user.list');

    });
});
