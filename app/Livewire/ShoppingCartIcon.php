<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class ShoppingCartIcon extends Component {
    public int $cartCount = 0;

    public function mount(CartService $cartService): void {
        $this->cartCount = $cartService->count();
    }

    #[On('cart-updated')]
    public function updateCartCount(CartService $cartService): void {
        $this->cartCount = $cartService->count();
    }

    public function render() {
        return view('livewire.shopping-cart-icon');
    }
}
