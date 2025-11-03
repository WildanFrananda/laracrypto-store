<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Product;
use App\Repositories\Contracts\StatsRepositoryInterface;
use App\Services\CartService;
use Livewire\Component;

class BestSellerCarousel extends Component {
    public bool $showQuickViewModal = false;

    public ?Product $quickViewProduct = null;

    public function quickView(int $productId): void {
        try {
            $this->quickViewProduct = Product::with('variants.material')->findOrFail($productId);
            $this->showQuickViewModal = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Product not found.');
        }
    }

    public function closeQuickViewModal(): void {
        $this->showQuickViewModal = false;
        $this->quickViewProduct = null;
    }

    public function addToCart(int $productId, CartService $cartService): void {
        try {
            $product = Product::with('variants')->findOrFail($productId);
            $firstVariant = $product->variants->first();

            if (!$firstVariant) {
                session()->flash('error', 'This product does not have any available variants.');

                return;
            }

            $cartService->add($firstVariant->id);
            $this->dispatch('cart-updated');
            session()->flash('message', 'Product successfully added to cart!');

            // Refresh component to show message
            $this->dispatch('$refresh');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to add product to cart. Please try again.');
        }
    }

    public function buyNow(int $productId, CartService $cartService): void {
        try {
            $product = Product::with('variants')->findOrFail($productId);
            $firstVariant = $product->variants->first();

            if (!$firstVariant) {
                session()->flash('error', 'This product does not have any available variants.');

                return;
            }

            $cartService->add($firstVariant->id);
            $this->dispatch('cart-updated');

            // Redirect to checkout
            $this->redirect(route('checkout.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to process your request. Please try again.');
        }
    }

    public function render(StatsRepositoryInterface $statsRepository) {
        $bestSellers = $statsRepository->getMostSellingProducts(4);

        return view('livewire.components.best-seller-carousel', [
            'bestSellers' => $bestSellers,
        ]);
    }
}
