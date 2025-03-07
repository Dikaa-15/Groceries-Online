<?php

use App\Livewire\CartIcon;
use App\Livewire\CartPage;
use App\Livewire\Checkout;
use App\Livewire\ProductList;
use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::middleware('guest')->group(function () {});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/products', ProductList::class)->name('products');

// Route::get('/cart', CartIcon::class)->name('cart');

Route::middleware('auth')->group(function () {
    Route::get('/products/{productId}', ProductDetail::class)->name('product.detail');
    Route::get('/cart', CartPage::class)->name('cart');
    Route::get('/checkout', Checkout::class)->middleware('auth')->name('checkout');

});
