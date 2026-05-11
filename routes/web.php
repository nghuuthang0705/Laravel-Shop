<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');

});

// Guest, Auth

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::post('/register', [AuthController::class, 'register']);
});