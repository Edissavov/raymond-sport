<?php

use App\http\Livewire\ProductCard;
use App\Http\Middleware\CanAccessCheckOut;
use App\Http\Middleware\CanAccessThanksPage;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use Illuminate\Support\Facades\Route;

use App\Livewire\Home;
use App\Livewire\Products;
use App\Livewire\ProductShow;
use App\Livewire\ThankYou;

Route::get('/', Home::class)->name('home');
Route::get('/products', Products::class)->name('products');
Route::get('/product/{slug}', ProductShow::class)->name('product-show');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout')->middleware(CanAccessCheckOut::class);
Route::get('/thank-you', ThankYou::class)
->middleware(CanAccessThanksPage::class)->name('thank-you');