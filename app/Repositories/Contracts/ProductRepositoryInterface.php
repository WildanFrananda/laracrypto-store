<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface {
    public function getAllPaginated(
        int $perPage = 12,
        array $filters = [],
        string $sortBy = 'latest'
    ): LengthAwarePaginator;

    public function findBySlug(string $slug): ?Product;

    public function getBestSellers(int $limit = 4): Collection;

    public function search(string $term, int $limit = 5): Collection;
}
