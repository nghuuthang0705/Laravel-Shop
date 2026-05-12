<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;

Route :: get('/', [HomeController :: class, 'index'])->name('home');

// Guest, Auth

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});