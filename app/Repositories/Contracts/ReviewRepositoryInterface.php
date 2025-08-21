<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReviewRepositoryInterface {
    public function getForProduct(Product $product, int $perPage = 5): LengthAwarePaginator;
}
