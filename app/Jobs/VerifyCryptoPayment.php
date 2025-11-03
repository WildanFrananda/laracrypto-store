<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Events\OrderCompleted;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Web3\Web3;

class VerifyCryptoPayment implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 10;

    public int $backoff = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $orderId, public string $txHash) {}

    /**
     * Execute the job.
     */
    public function handle(): void {
        $order = Order::find($this->orderId);

        if (!$order || $order->status !== OrderStatus::AWAITING_CONFIRMATION) {
            Log::info('Verification skipped for order: '.$this->orderId);

            return;
        }

        try {
            $web3 = new Web3(config('services.sepolia.rpc_url'));
            $receipt = $web3->eth()->getTransactionReceipt($this->txHash);

            if ($receipt === null) {
                Log::info("Order #{$order->id} payment is still pending. Releasing job back to queue.");
                $this->release($this->backoff);

                return;
            }

            if (isset($receipt['status']) && $receipt['status'] == '1') {
                $order->update(['status' => 'completed']);
                OrderCompleted::dispatch($order);
                Log::info("Order #{$order->id} payment confirmed successfully.");
            } elseif (isset($receipt['status']) && $receipt['status'] == '0') {
                $order->update(['status' => 'failed']);
                Log::error("Order #{$order->id} payment failed on-chain (status 0x0).");
            } else {
                Log::warning("Unexpected receipt status {$receipt['status']} for Order #{$order->id}. Releasing job.");
                $this->release($this->backoff);
            }
        } catch (Exception $e) {
            Log::critical("Critical error verifying order {$this->orderId}: ".$e->getMessage());
            $this->fail($e);
        }
    }
}
