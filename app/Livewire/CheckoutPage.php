<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Jobs\VerifyCryptoPayment;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutPage extends Component {
    public $cart = [];

    public $totalUSD = 0;

    public $totalETH = 0;

    public ?Order $order = null;

    public function mount() {
        $this->updateCart();
    }

    public function updateCart() {
        $this->cart = session()->get('cart', []);
        $this->totalUSD = collect($this->cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $ethPrice = Cache::get('eth_price_usd');

        if ($ethPrice) {
            $this->totalETH = $this->totalUSD / $ethPrice;
        }
    }

    public function removeItem(int $productId) {
        session()->forget("cart.{$productId}");
        $this->updateCart();
        $this->dispatch('cart-updated');
    }

    public function placeOrder() {
        if (empty($this->cart)) {
            $this->dispatch('error', 'Your cart is empty.');

            return;
        }

        $this->order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $this->totalUSD,
            'crypto_amount' => $this->totalETH,
            'crypto_currency' => 'ETH',
            'status' => 'pending',
            'recipient_address' => config('services.crypto.store_wallet_address'),
        ]);

        $this->dispatch('initiate-payment', [
            'amount' => (string) $this->order->crypto_amount,
            'toAddress' => $this->order->recipient_address,
        ]);
    }

    #[On('payment-sent')]
    public function handlePaymentSent(string $txHash) {
        if ($this->order) {
            $this->order->update([
                'transaction_hash' => $txHash,
                'status' => 'awaiting_confirmation',
            ]);
        }

        VerifyCryptoPayment::dispatch($this->order->id)
            ->onQueue('payments');

        session()->forget('cart');
        $this->dispatch('cart-updated');

        return $this->redirect('/order-summary/'.$this->order->id, navigate: true);
    }

    public function render() {
        return view('livewire.checkout-page')->layout('layouts.app')
            ->with([
                'cart' => $this->cart,
                'totalUSD' => $this->totalUSD,
                'totalETH' => $this->totalETH,
                'order' => $this->order,
            ]);
    }
}
