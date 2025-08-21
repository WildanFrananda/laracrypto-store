<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Models\ProductVariant;
use Exception;

class InsufficientStockException extends Exception {
    public static function forVariant(ProductVariant $variant): self {
        return new self("Insufficient stock for product variant: {$variant->product->name} ({$variant->material->name})");
    }
}
