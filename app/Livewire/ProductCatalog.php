<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Color;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalog extends Component {
    use WithPagination;

    #[Url(as: 'sort', keep: true)]
    public string $sortBy = 'latest';

    #[Url(keep: true)]
    public array $selectedColors = [];

    #[Url(as: 'price', keep: true)]
    public ?int $maxPrice = null;

    public Collection $availableColors;

    public function mount(): void {
        $this->availableColors = Color::all();
    }

    public function updated(): void {
        $this->resetPage();
    }

    public function render(ProductRepositoryInterface $productRepository) {
        $filters = [
            'colors' => array_filter($this->selectedColors),
            'max_price' => $this->maxPrice,
        ];

        $products = $productRepository->getAllPaginated(
            perPage: 9,
            filters: array_filter($filters),
            sortBy: $this->sortBy
        );

        return view('livewire.product-catalog', [
            'products' => $products,
        ])->layout('layouts.app');
    }
}
