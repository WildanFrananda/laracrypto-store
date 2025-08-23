<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use App\Livewire\AboutUsPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\ContactPage;
use App\Livewire\HomePage;
use App\Livewire\LatestBlock;
use App\Livewire\PaymentPage;
use App\Livewire\ProductCatalog;
use App\Livewire\ProductDetail;
use App\Livewire\ProfilePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/products', ProductCatalog::class)->name('products.catalog');
Route::get('/products/{slug}', ProductDetail::class)->name('products.detail');
Route::get('/cart', CartPage::class)->name('cart.index');
Route::get('/checkout', CheckoutPage::class)
    ->name('checkout.index')
    ->middleware('auth');
Route::get('/orders/{order}/payment', PaymentPage::class)
    ->name('orders.payment')
    ->middleware('auth');
Route::get('/contact', ContactPage::class)->name('contact.index');
Route::get('/about-us', AboutUsPage::class)->name('about.index');
Route::get('/profile', ProfilePage::class)
    ->name('profile.show')
    ->middleware('auth');

Route::get('/latest-block', LatestBlock::class)
    ->middleware(['auth', 'verified'])
    ->name('latest-block');

Route::get('/dashboard', ProductCatalog::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
