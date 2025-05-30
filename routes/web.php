<?php

use App\Livewire\CartPage;
use App\Livewire\Checkout;
use App\Livewire\ProductList;
use App\Livewire\DetailProduct;
use App\Livewire\ProductDetail;
use App\Livewire\MyTransactions;
use App\Http\Livewire\ProductRates;
use App\Http\Livewire\ProductReview;
use App\Livewire\User\DashboardUser;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CheckoutConfirm;
use App\Http\Controllers\ProfileController;
use App\Livewire\ProductReview as LivewireProductReview;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', ProductList::class)->name('products');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/products/{id}', DetailProduct::class)->name('product.detail');
    Route::get('/products/{category}-{name}', DetailProduct::class)->name('product.detail');

    Route::get('/cart', CartPage::class)->name('cart');
    Route::get('/checkout/{directCheckout?}', Checkout::class)->name('checkout');
    // web.php
    Route::get('/review/product/{name}', LivewireProductReview::class)->name('review.product');

    // Route::get('/checkout/confirm', CheckoutConfirm::class)->middleware('auth')->name('checkout.confirm');
    Route::get('/user/dashboard', DashboardUser::class)->name('user.dashboard');
    Route::get('/my-transactions', MyTransactions::class)->name('my-transactions');
});


require __DIR__ . '/auth.php';
