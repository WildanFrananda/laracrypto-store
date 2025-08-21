<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\User;

class ReviewService {
    public function create(User $user, Product $product, int $rating, ?string $comment): void {
        $product->reviews()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'rating' => $rating,
                'comment' => $comment,
            ]
        );
    }
}
