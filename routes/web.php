<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController; 

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
//Thêm các đường dẫn create, delete and update product
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');

    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    // Tham so product cua URL
    Route::put('/products/{product}', [AdminProductController :: class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminProductController :: class, 'destroy'])->name('admin.products.destroy');
});