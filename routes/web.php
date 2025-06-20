<?php

use App\http\Livewire\ProductCard;
use App\Http\Middleware\CanAccessCheckOut;
use App\Http\Middleware\CanAccessThanksPage;
use App\Livewire\AboutUs;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\Faq;
use Illuminate\Support\Facades\Route;

use App\Livewire\Home;
use App\Livewire\Products;
use App\Livewire\ProductShow;
use App\Livewire\Terms;
use App\Livewire\ThankYou;

Route::get('/', Home::class)->name('home');
Route::get('/products', Products::class)->name('products');
Route::get('/products/category/{category:slug}', Products::class)->name('products.category');
Route::get('/product/{slug}', ProductShow::class)->name('product-show');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout')->middleware(CanAccessCheckOut::class);
// Route::get('/thank-you', ThankYou::class)
// ->middleware(CanAccessThanksPage::class)->name('thank-you');
Route::get('/thank-you', ThankYou::class)->name('thank-you');
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/terms', Terms::class)->name('terms');
Route::get('/faq', Faq::class)->name('faq');
