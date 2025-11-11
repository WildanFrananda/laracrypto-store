<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Jobs\VerifyCryptoPayment;
use App\Models\Order;
use App\Services\PaymentService;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentPage extends Component {
    public Order $order;

    public ?float $cryptoAmount = null;

    public ?string $recipientAddress = null;

    public bool $isProcessing = false;

    public ?string $midtransSnapToken = null;

    public function mount(Order $order, PaymentService $paymentService): void {
        abort_if($order->user_id !== auth()->id(), 403);

        $this->order = $order;
        $this->recipientAddress = config('services.crypto.store_wallet_address');

        if (in_array($this->order->status->value, ['awaiting_confirmation', 'completed', 'failed'])) {
            $this->isProcessing = true;
        } else {
            $web3PaymentData = $paymentService->prepareWeb3Payment($this->order);
            if ($web3PaymentData) {
                $this->cryptoAmount = $web3PaymentData['amount'];
            }
            $this->midtransSnapToken = $paymentService->createMidtransSnapToken($this->order);
        }
    }

    public function handleMidtransSuccess($result): void {
        // Update payment record
        $this->order->payments()->create([
            'transaction_id' => $result['transaction_id'] ?? $result['order_id'],
            'amount' => $this->order->total_amount,
            'status' => 'completed',
        ]);

        // Update order status
        $this->order->update([
            'status' => 'awaiting_confirmation',
            'payment_method' => 'midtrans',
            'transaction_hash' => $result['transaction_id'] ?? null,
        ]);

        $this->isProcessing = true;

        // Force refresh to show success state
        $this->checkOrderStatus();
    }

    public function handleMidtransPending($result): void {
        $this->order->payments()->create([
            'transaction_id' => $result['transaction_id'] ?? $result['order_id'],
            'amount' => $this->order->total_amount,
            'status' => 'pending',
        ]);

        $this->order->update([
            'status' => 'awaiting_confirmation',
            'payment_method' => 'midtrans',
        ]);

        $this->isProcessing = true;
    }

    #[On('payment-sent')]
    public function handlePaymentSent(string $txHash): void {
        $this->order->payments()->create([
            'transaction_id' => $txHash,
            'amount' => $this->order->total_amount,
            'status' => 'processing',
        ]);

        $this->order->update([
            'status' => 'awaiting_confirmation',
            'transaction_hash' => $txHash,
            'payment_method' => 'crypto',
            'crypto_amount' => $this->cryptoAmount,
        ]);

        VerifyCryptoPayment::dispatch($this->order->id, $txHash);

        $this->isProcessing = true;
    }

    public function checkOrderStatus(): void {
        $this->order->refresh();
    }

    public function render() {
        return view('livewire.payment-page')
            ->layout('layouts.app');
    }
}
