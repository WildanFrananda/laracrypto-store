<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use App\Livewire\CheckoutPage;
use App\Livewire\LatestBlock;
use App\Livewire\ProductCatalog;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/latest-block', LatestBlock::class)
    ->middleware(['auth', 'verified'])
    ->name('latest-block');

Route::get('/dashboard', ProductCatalog::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/order-summary/{order}', function (Order $order) {
    abort_if($order->user_id !== auth()->id(), 403);

    return "Thank you! Your order #{$order->id} is being processed. Transaction Hash: {$order->transaction_hash}";
})->middleware('auth')->name('order.summary');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', CheckoutPage::class)->name('checkout');
});

require __DIR__.'/auth.php';
