<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService {
    public function __construct(
        private readonly CartService $cartService
    ) {}

    public function createFromCart(User $user): Order {
        $cartItems = $this->cartService->get();
        $totalAmount = $this->cartService->getTotal();

        return DB::transaction(function () use ($user, $cartItems, $totalAmount) {
            foreach ($cartItems as $variantId => $item) {
                $variant = ProductVariant::find($variantId);
                if ($variant->stock < $item['quantity']) {
                    throw InsufficientStockException::forVariant($variant);
                }
            }

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-'.strtoupper(Str::random(10)),
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $variantId => $item) {
                $order->items()->create([
                    'product_variant_id' => $variantId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            return $order;
        });
    }
}
