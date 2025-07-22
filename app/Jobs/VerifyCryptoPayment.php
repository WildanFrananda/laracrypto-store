<?php

declare(strict_types=1);

namespace App\Jobs;

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
    public function __construct(public int $orderId) {}

    /**
     * Execute the job.
     */
    public function handle(): void {
        $order = Order::find($this->orderId);

        if (!$order || $order->status !== 'awaiting_confirmation') {
            Log::info('Verification skipped for order: '.$this->orderId);

            return;
        }

        try {
            $web3 = new Web3(config('services.sepolia.rpc_url'));
            $receipt = $web3->eth()->getTransactionReceipt($order->transaction_hash);

            if ($receipt === null) {
                Log::warning("Order {$order->id} payment not confirmed yet.");

                return;
            }

            if (isset($receipt['status']) && $receipt['status'] === '0x1') {
                $order->update(['status' => 'completed']);
                Log::info("Order {$order->id} payment confirmed successfully.");
            } else {
                Log::error("Error fetching transaction receipt for order {$order->id}. Status: {$receipt['status']}");
            }
        } catch (Exception $e) {
            Log::critical("Critical error verifying order {$this->orderId}: ".$e->getMessage());
            $this->fail($e);
        }
    }
}
