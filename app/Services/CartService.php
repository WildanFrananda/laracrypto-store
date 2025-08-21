<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Collection;

class CartService {
    public function add(int $productVariantId, int $quantity = 1): void {
        $cart = $this->get();
        $cartItem = $cart->get($productVariantId);

        if ($cartItem) {
            $cartItem['quantity'] += $quantity;
            $cart->put($productVariantId, $cartItem);
        } else {
            $variant = ProductVariant::with('product', 'material')->findOrFail($productVariantId);
            $cart->put($productVariantId, [
                'product_id' => $variant->product->id,
                'product_name' => $variant->product->name,
                'variant_id' => $variant->id,
                'material' => $variant->material->name,
                'price' => $variant->price,
                'quantity' => $quantity,
            ]);
        }

        session()->put('cart', $cart);
    }

    public function updateQuantity(int $productVariantId, int $quantity): void {
        $cart = $this->get();
        $cartItem = $cart->get($productVariantId);

        if ($cartItem) {
            if ($quantity > 0) {
                $cartItem['quantity'] = $quantity;
                $cart->put($productVariantId, $cartItem);
                session()->put('cart', $cart);
            } else {
                $this->remove($productVariantId);
            }
        }
    }

    public function remove(int $productVariantId): void {
        $cart = $this->get();
        $cart->forget($productVariantId);
        session()->put('cart', $cart);
    }

    public function getTotal(): float {
        return $this->get()->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function get(): Collection {
        return collect(session()->get('cart', []));
    }

    public function count(): int {
        return $this->get()->count();
    }
}
