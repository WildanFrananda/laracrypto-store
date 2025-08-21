<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Exceptions\InsufficientStockException;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Collection;
use Livewire\Component;

class CheckoutPage extends Component {
    public Collection $cartItems;

    public float $total = 0.0;

    public function mount(CartService $cartService): void {
        $this->cartItems = $cartService->get();
        $this->total = $cartService->getTotal();

        if ($this->cartItems->isEmpty()) {
            $this->redirect(route('cart.index'));
        }
    }

    public function placeOrder(OrderService $orderService, CartService $cartService): void {
        $user = auth()->user();

        try {
            $order = $orderService->createFromCart($user);

            session()->forget('cart');
            $this->dispatch('cart-updated');
            $this->redirect(route('orders.payment', $order));

        } catch (InsufficientStockException $e) {
            session()->flash('error', $e->getMessage());
            $this->redirect(route('cart.index'));
        }
    }

    public function render() {
        return view('livewire.checkout-page')
            ->layout('layouts.app');
    }
}
