<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Livewire\Component;

class CategoryGrid extends Component {
    public function render(CategoryRepositoryInterface $categoryRepository) {
        $categories = $categoryRepository->getFeatured();

        return view('livewire.components.category-grid', [
            'categories' => $categories,
        ]);
    }
}
