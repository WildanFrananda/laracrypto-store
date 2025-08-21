<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Livewire\Component;

class BestSellerCarousel extends Component {
    public function render(ProductRepositoryInterface $productRepository) {
        $bestSellers = $productRepository->getBestSellers(4);

        return view('livewire.components.best-seller-carousel', [
            'bestSellers' => $bestSellers,
        ]);
    }
}
