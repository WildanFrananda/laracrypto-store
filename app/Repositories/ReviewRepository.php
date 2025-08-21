<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReviewRepository implements ReviewRepositoryInterface {
    public function getForProduct(Product $product, int $perPage = 5): LengthAwarePaginator {
        return $product->reviews()
            ->with('user')
            ->latest()
            ->paginate($perPage);
    }
}
