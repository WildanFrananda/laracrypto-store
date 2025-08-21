<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Product;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistButton extends Component {
    public Product $product;

    public bool $isInWishlist = false;

    public function mount(): void {
        $this->updateStatus();
    }

    public function toggleWishlist(WishlistService $wishlistService): void {
        if (!Auth::check()) {
            $this->redirect(route('login'));

            return;
        }

        $wishlistService->toggle(Auth::user(), $this->product->id);
        $this->updateStatus();
        $this->dispatch('wishlist-updated');
    }

    private function updateStatus(): void {
        if (Auth::check()) {
            $this->isInWishlist = Auth::user()->wishlist()->where('product_id', $this->product->id)->exists();
        }
    }

    public function render() {
        return view('livewire.components.wishlist-button');
    }
}
