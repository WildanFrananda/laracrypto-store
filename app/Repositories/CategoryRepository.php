<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface {
    public function getFeatured(): Collection {
        return Category::query()
            ->take(4)
            ->get();
    }
}
