<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\CartService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductDetail extends Component {
    public Product $product;

    public ?int $selectedMaterialId = null;

    public ?int $selectedColorId = null;

    public int $quantity = 1;

    public ?string $mainImageUrl = null;

    public Collection $imagesForSelectedColor;

    public function mount(string $slug, ProductRepositoryInterface $productRepository): void {
        $this->product = $productRepository->findBySlug($slug);
        $this->selectedMaterialId = $this->product->variants->first()?->material_id;
        $this->selectedColorId = $this->product->colors->first()?->id;
        $this->imagesForSelectedColor = collect();
        $this->updateImages();
    }

    public function updatedSelectedColorId(): void {
        $this->updateImages();
    }

    public function setMainImage(string $url): void {
        $this->mainImageUrl = $url;
    }

    private function updateImages(): void {
        // Get all media for the product
        $allMedia = $this->product->getMedia('products');

        Log::info('Updating images for product', [
            'product_id' => $this->product->id,
            'selected_color_id' => $this->selectedColorId,
            'total_media_count' => $allMedia->count(),
        ]);

        if ($this->selectedColorId) {
            // Filter media by selected color
            $this->imagesForSelectedColor = $allMedia->filter(function ($media) {
                $mediaColorId = $media->getCustomProperty('color_id');

                Log::debug('Checking media color', [
                    'media_id' => $media->id,
                    'media_color_id' => $mediaColorId,
                    'selected_color_id' => $this->selectedColorId,
                    'matches' => $mediaColorId == $this->selectedColorId,
                ]);

                return $mediaColorId == $this->selectedColorId;
            });
        } else {
            // If no color selected, show all images
            $this->imagesForSelectedColor = $allMedia;
        }

        // Set main image to the first image of selected color, or first available image
        $firstImage = $this->imagesForSelectedColor->first();
        $this->mainImageUrl = $firstImage ? $firstImage->getFullUrl() : null;

        // Fallback: if no images for selected color, use first available image
        if (!$this->mainImageUrl && $allMedia->isNotEmpty()) {
            $this->mainImageUrl = $allMedia->first()->getFullUrl();
            $this->imagesForSelectedColor = collect([$allMedia->first()]);
        }

        Log::info('Images updated', [
            'filtered_images_count' => $this->imagesForSelectedColor->count(),
            'main_image_url' => $this->mainImageUrl,
        ]);
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

    public function decrementQuantity(): void {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function incrementQuantity(): void {
        $variant = $this->selectedVariant();
        if (!$variant) {
            return;
        }

        if ($this->quantity < $variant->stock) {
            $this->quantity++;
        } else {
            session()->flash('error', "Sorry, only {$variant->stock} available.");
        }
    }

    public function addToCart(CartService $cartService): void {
        $variant = $this->selectedVariant();

        if (!$variant) {
            session()->flash('error', 'Please select a material first.');

            return;
        }

        $quantityInCart = $cartService->get()->get($variant->id)['quantity'] ?? 0;
        $totalQuantity = $quantityInCart + $this->quantity;

        if ($variant->stock < $totalQuantity) {
            session()->flash('error', "Sorry, insufficient stock. Available: {$variant->stock}, in your cart: {$quantityInCart}.");

            return;
        }

        $cartService->add($variant->id, $this->quantity);

        $this->dispatch('cart-updated');
        session()->flash('message', 'Product added to cart successfully!');

        $this->quantity = 1;
    }

    public function buyNow(CartService $cartService): void {
        $variant = $this->selectedVariant();

        if (!$variant) {
            session()->flash('error', 'Please select a material first.');

            return;
        }

        if ($variant->stock < $this->quantity) {
            session()->flash('error', "Sorry, insufficient stock. Available: {$variant->stock}.");

            return;
        }

        $cartService->replaceAndAdd($variant->id, $this->quantity);

        $this->dispatch('cart-updated');
        $this->redirect(route('checkout.index'));
    }

    public function render(): mixed {
        return view('livewire.product-detail')
            ->layout('layouts.app');
    }
}
