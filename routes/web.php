<?php


use App\Http\Livewire\ProductCard;
use App\Http\Middleware\CanAccessCheckOut;
use App\Http\Middleware\CanAccessThanksPage;
use App\Livewire\AboutUs;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register; // Add this import
use App\Livewire\BlogPosts;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\ContactUs;
use App\Livewire\Faq;
use App\Livewire\OrderHistory;
use App\Livewire\ShowPost;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\OrderShow;
use App\Livewire\Products;
use App\Livewire\ProductShow;
use App\Livewire\Terms;
use App\Livewire\ThankYou;
use App\Livewire\Profile;
use App\Models\Order;

Route::get('/', Home::class)->name('home');
Route::get('/products', Products::class)->name('products');
Route::get('/products/category/{category:slug}', Products::class)->name('products.category');
Route::get('/product/{slug}', ProductShow::class)->name('product-show');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout')->middleware(CanAccessCheckOut::class);
Route::get('/thank-you', ThankYou::class)->name('thank-you');
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/terms', Terms::class)->name('terms');
Route::get('/faq', Faq::class)->name('faq');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Logout Route - must use POST for security
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/info', Profile::class)->name('profile.info');
        Route::get('/orders', OrderHistory::class)->name('profile.orders');
        Route::redirect('/', '/profile/info')->name('profile');
    });

    // Order detail route
    Route::get('/orders/{order}', OrderShow::class)->name('orders.show');
});
Route::get('/contact-us', ContactUs::class )->name('contact-us');
Route::get('/blog', BlogPosts::class)->name('blog.index');
Route::get('/blog/{slug}', ShowPost::class)->name('blog.show');
