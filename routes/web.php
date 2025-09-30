<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDownloadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\CaptchaController;

Route::get('/', HomeController::class)->name('home');

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('products')->group(function () {
    Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware(['auth', 'admin']);
    Route::post('/', [ProductController::class, 'store'])->name('products.store')->middleware(['auth', 'admin']);
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/edit/{product:slug}', [ProductController::class, 'edit'])->name('products.edit')->middleware(['auth', 'admin']);
    Route::put('/{product:slug}', [ProductController::class, 'update'])->name('products.update')->middleware(['auth', 'admin']);
    Route::delete('/{product:slug}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware(['auth', 'admin']);
    Route::get('/downloads/{product:slug}', [ProductDownloadController::class, 'show'])->name('products.downloads.show')->middleware('auth');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/products', [CartProductController::class, 'store'])->name('cart.products.store');
    Route::delete('/products/{product:slug}', [CartProductController::class, 'destroy'])->name('cart.products.destroy');
});

Route::prefix('wishlist')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.show')->middleware('auth');
    Route::post('/{product:slug}', [WishlistController::class, 'toggle'])->name('wishlist.toggle')->middleware('auth');
});

Route::prefix('reviews')->group(function () {
    Route::get('/{product:slug}', [ReviewsController::class, 'create'])->name('reviews.create')->middleware('auth');
    Route::post('/', [ReviewsController::class, 'store'])->name('reviews.store');
});

Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::post('/pay', [CheckoutController::class, 'pay'])->name('fakepay')->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth', 'admin');

Route::get('/captcha', [CaptchaController::class, 'getCaptcha'])->name('captcha');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index')->middleware('auth');

require __DIR__.'/auth.php';
