<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController; 

use App\Http\Controllers\ProductController;

use App\Http\Controllers\CartController;


Route :: get('/', [HomeController :: class, 'index'])->name('home');

// Guest, Auth

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::post('/register', [AuthController::class, 'register']);

    // Chi tiết sản phẩm (public)
    Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

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