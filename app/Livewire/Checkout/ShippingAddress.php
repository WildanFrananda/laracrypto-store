<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Exceptions\InsufficientStockException;
use App\Models\Address;
use App\Services\OrderService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingAddress extends Component {
    public Collection $addresses;

    public ?int $selectedAddressId = null;

    public function mount(): void {
        $this->loadAddresses();
        $this->selectedAddressId = $this->addresses->firstWhere('is_primary', true)?->id;
    }

    public function proceedToPayment(OrderService $orderService): void {
        $this->validate(
            ['selectedAddressId' => 'required'],
            ['selectedAddressId.required' => 'Please select a shipping address.']
        );

        $user = Auth::user();
        $shippingAddress = Address::find($this->selectedAddressId);

        try {
            $order = $orderService->createFromCart($user, $shippingAddress);

            session()->forget('cart');
            $this->dispatch('cart-updated');
            $this->redirect(route('orders.payment', $order));

        } catch (InsufficientStockException $e) {
            session()->flash('error', $e->getMessage());
            $this->redirect(route('cart.index'));
        }
    }

    private function loadAddresses(): void {
        $this->addresses = Auth::user()->addresses()->latest()->get();
    }

    public function render() {
        return view('livewire.checkout.shipping-address')
            ->layout('layouts.app');
    }
}
