<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface {
    public function getAllPaginated(
        int $perPage = 12,
        array $filters = [],
        string $sortBy = 'latest'
    ): LengthAwarePaginator {
        $query = Product::query()->with(['category', 'variants']);
        $this->applyFilters($query, $filters);
        $this->applySorting($query, $sortBy);

        return $query->paginate($perPage);
    }

    private function applyFilters(Builder $query, array $filters): void {
        if (isset($filters['colors'])) {
            $query->whereHas('colors', function (Builder $q) use ($filters) {
                $q->whereIn('colors.id', $filters['colors']);
            });
        }

        if (isset($filters['max_price'])) {
            $query->where('base_price', '<=', $filters['max_price']);
        }
    }

    private function applySorting(Builder $query, string $sortBy): void {
        match ($sortBy) {
            'price_asc' => $query->orderBy('base_price', 'asc'),
            'price_desc' => $query->orderBy('base_price', 'desc'),
            default => $query->latest(),
        };
    }

    public function findBySlug(string $slug): ?Product {
        return Product::query()
            ->where('slug', $slug)
            ->with([
                'category',
                'variants.material',
                'colors',
            ])
            ->firstOrFail();
    }

    public function getBestSellers(int $limit = 4): Collection {
        return Product::query()
            ->with('category')
            ->latest()
            ->take($limit)
            ->get();
    }

    public function search(string $term, int $limit = 5): Collection {
        if (empty(trim($term))) {
            return collect();
        }

        $searchTerms = array_filter(explode(' ', $term));

        if (empty($searchTerms)) {
            return collect();
        }

        return Product::query()
            ->where(function (Builder $query) use ($searchTerms) {
                foreach ($searchTerms as $word) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$word}%")
                        ->orWhere('description', 'LIKE', "%{$word}%");
                }
            })
            ->take($limit)
            ->get();
    }
}
