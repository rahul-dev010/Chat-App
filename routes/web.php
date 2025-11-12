<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController; // ✅ New User Controller added

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    // Handle Login Submission
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

// Handle Logout (Requires login)
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// ==========================================================
// ADMIN ROUTES
// ==========================================================
Route::prefix('admin')->group(function () {
    // Login Routes (Guests only)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    });
    
    // Protected Admin Routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/chat' , [AdminDashboardController::class , 'groupChat'])->name('admin.group.chat');

        // add new user and list --
        Route::get('/add-user',[AdminDashboardController::class , 'addUser'])->name('admin.add.user');
        Route::post('/add-user',[AdminDashboardController::class , 'addUserStore'])->name('admin.add.user.store');
        Route::get('/user-list',[AdminDashboardController::class ,'usersList'] )->name('admin.user.list');

    });
    // Admin Logout is typically inside the admin middleware, or explicitly defined:
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout'); // If you want to use a separate logout for admin

});


// ==========================================================
// PROTECTED USER GROUP CHAT ROUTES
// ==========================================================
// 💡 IMPORTANT: All group routes are now protected by the 'auth' middleware.
Route::middleware(['auth'])->group(function () {

    Route::get('groups/create', [GroupController::class, 'create'])->name('user.groups.create');
    Route::post('groups', [GroupController::class, 'storeGroup'])->name('user.groups.store');

    // Group Chat Routes
    Route::get('groups/{group}/chat', [GroupController::class, 'index'])->name('user.groups.chat');
    Route::post('groups/{group}/chat', [GroupController::class, 'store'])->name('user.groups.chat.store');
    Route::get('groups/{group}/chat/messages', [GroupController::class, 'messages'])->name('user.groups.chat.messages');
});

// A simple home route
Route::get('/', function () {
    return view('welcome'); // Assuming you have a default welcome blade file
});