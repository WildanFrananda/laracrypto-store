<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\OrderCompleted;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentService {
    public function __construct() {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function createMidtransSnapToken(Order $order): ?string {
        $user = $order->user;
        $itemDetails = $order->items->map(function ($item) {
            return [
                'id' => $item->variant->id,
                'price' => (int) $item->price,
                'quantity' => $item->quantity,
                'name' => $item->variant->product->name.' ('.$item->variant->material->name.')',
            ];
        })->toArray();

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => $itemDetails,
        ];

        try {
            return Snap::getSnapToken($params);
        } catch (Exception $e) {
            Log::error('Midtrans Snap Token Error: '.$e->getMessage());

            return null;
        }
    }

    public function prepareWeb3Payment(Order $order): ?array {
        $ethPriceIdr = Cache::remember('eth_price_idr', now()->addMinutes(5), function () {
            try {
                $response = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=idr');

                if ($response->successful() && isset($response->json()['ethereum']['idr'])) {
                    return (float) $response->json()['ethereum']['idr'];
                }

                return null;
            } catch (Exception $e) {
                return null;
            }
        });

        if (is_null($ethPriceIdr) || $ethPriceIdr === 0.0) {
            return null;
        }

        $cryptoAmount = $order->total_amount / $ethPriceIdr;

        return [
            'amount' => $cryptoAmount,
            'currency' => 'ETH',
        ];
    }

    public function handleMidtransNotification(): ?Order {
        try {
            $notification = new Notification;
        } catch (Exception $e) {
            Log::error('Midtrans Notification Error: '.$e->getMessage());

            return null;
        }

        $transactionStatus = $notification->transaction_status;
        $orderNumber = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            Log::warning("Midtrans Webhook: Order not found with number {$orderNumber}");

            return null;
        }

        if ($order->status === 'completed' || $order->status === 'failed') {
            return $order;
        }

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if ($fraudStatus == 'accept') {
                $order->update([
                    'status' => 'completed',
                    'payment_method' => 'midtrans',
                ]);
                OrderCompleted::dispatch($order);
            }
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $order->update(['status' => 'failed']);
        }

        $order->payments()->updateOrCreate(
            ['transaction_id' => $notification->transaction_id],
            [
                'amount' => (float) $notification->gross_amount,
                'status' => $transactionStatus,
            ]
        );

        return $order;
    }
}
