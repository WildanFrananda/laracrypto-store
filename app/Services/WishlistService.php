<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class WishlistService {
    public function toggle(User $user, int $productId): void {
        $user->wishlist()->toggle($productId);
    }

    public function count(User $user): int {
        return $user->wishlist()->count();
    }
}
