<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchBar extends Component {
    public string $searchTerm = '';

    public Collection $results;

    public function mount(): void {
        $this->results = collect();
    }

    public function updated(
        string $property,
        ProductRepositoryInterface $productRepository
    ): void {

        if ($property === 'searchTerm') {
            $this->results = $productRepository->search($this->searchTerm);
        }
    }

    public function render() {
        return view('livewire.search-bar');
    }
}
