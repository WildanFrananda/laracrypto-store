<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Services\CartService;
use Illuminate\Support\Collection;
use Livewire\Component;

class CartPage extends Component {
    public Collection $cartItems;

    public float $total = 0.0;

    public function mount(CartService $cartService): void {
        $this->loadCartData($cartService);
    }

    public function updateQuantity(int $variantId, string $quantity, CartService $cartService): void {
        $quantity = (int) $quantity;

        if ($quantity < 1) {
            $cartService->updateQuantity($variantId, 1);
            $this->loadCartData($cartService);
            session()->flash('error', 'Minimum quantity is 1');

            return;
        }

        $cartService->updateQuantity($variantId, $quantity);
        $this->loadCartData($cartService);
        $this->dispatch('cart-updated');
    }

    public function removeItem(int $variantId, CartService $cartService): void {
        $cartService->remove($variantId);
        $this->loadCartData($cartService);
        $this->dispatch('cart-updated');
    }

    private function loadCartData(CartService $cartService): void {
        $this->cartItems = $cartService->get();
        $this->total = $cartService->getTotal();
    }

    public function render(): mixed {
        return view('livewire.cart-page')
            ->layout('layouts.app');
    }
}
