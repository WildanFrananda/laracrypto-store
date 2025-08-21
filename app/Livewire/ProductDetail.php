<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\CartService;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductDetail extends Component {
    public Product $product;

    public ?int $selectedMaterialId = null;

    public ?int $selectedColorId = null;

    public int $quantity = 1;

    public function mount(string $slug, ProductRepositoryInterface $productRepository): void {
        $this->product = $productRepository->findBySlug($slug);
        $this->selectedMaterialId = $this->product->variants->first()?->material_id;
        $this->selectedColorId = $this->product->colors->first()?->id;
    }

    #[Computed]
    public function selectedVariant(): ?ProductVariant {
        if (!$this->selectedMaterialId) {
            return null;
        }

        return $this->product->variants()
            ->where('material_id', $this->selectedMaterialId)
            ->first();
    }

    public function addToCart(CartService $cartService): void {
        $variant = $this->selectedVariant();

        if (!$variant) {
            session()->flash('error', 'Please select a material first.');

            return;
        }

        if ($variant->stock < $this->quantity) {
            session()->flash('error', "Sorry, insufficient stock. {$variant->stock} Available.");

            return;
        }

        $cartService->add($variant->id, $this->quantity);
        $this->dispatch('cart-updated');
        session()->flash('message', 'Product added to cart successfully!');
    }

    public function render(): mixed {
        return view('livewire.product-detail')
            ->layout('layouts.app');
    }
}
