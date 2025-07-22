<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class ProductCatalog extends Component {
    public function addToCart(int $productId): void {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->getAttribute('name'),
                'price' => $product->getAttribute('price'),
                'quantity' => 1,
                'image_url' => $product->getAttribute('image_url'),
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
        session()->flash('message', 'Product added to cart successfully!');
    }

    public function render(): Component|View {
        $products = Product::all();

        $ethPrice = Cache::remember(
            'eth_price_usd',
            now()->addMinutes(10),
            function () {
                try {
                    $response = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd');

                    if ($response->successful() && isset($response['ethereum']['usd'])) {
                        return $response->json()['ethereum']['usd'];
                    }

                    return null;
                } catch (Exception $e) {
                    return null;
                }
            });

        return view('livewire.product-catalog', [
            'products' => $products,
            'ethPrice' => $ethPrice,
        ])->layout('layouts.app', [
            'title' => 'Product Catalog',
            'description' => 'Browse our collection of Web3-themed products.',
        ]);
    }
}
