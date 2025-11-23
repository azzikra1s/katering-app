<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'merchant') {
        return redirect()->route('merchant.dashboard');
    }
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Merchant Routes
Route::middleware(['auth'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/dashboard', [MerchantController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [MerchantController::class, 'profile'])->name('profile');
    Route::post('/profile', [MerchantController::class, 'updateProfile'])->name('profile.update');
    
    Route::resource('menus', MenuController::class);
    
    Route::get('/orders', [MerchantController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [MerchantController::class, 'orderDetail'])->name('orders.detail');
});

// Customer Routes
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/merchants', [CustomerController::class, 'merchants'])->name('merchants');
    Route::get('/merchants/{merchant}', [CustomerController::class, 'merchantDetail'])->name('merchants.detail');
    
    Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::delete('/cart/{item}', [OrderController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [CustomerController::class, 'orderDetail'])->name('orders.detail');
});

require __DIR__.'/auth.php';
