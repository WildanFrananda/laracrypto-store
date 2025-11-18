<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface {
    public function getAll(): Collection {
        return Category::query()
            ->with('media') // Eager load media
            ->get();
    }

    public function getFeatured(int $limit = 4): Collection {
        return Category::query()
            ->with('media') // Eager load media
            ->latest()
            ->take($limit)
            ->get();
    }

    public function findBySlug(string $slug): ?Category {
        return Category::query()
            ->with('media') // Eager load media
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
