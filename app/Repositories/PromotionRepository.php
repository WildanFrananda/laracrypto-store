<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\Contracts\PromotionRepositoryInterface;
use Illuminate\Support\Collection;

class PromotionRepository implements PromotionRepositoryInterface {
    public function getActivePromotions(int $limit = 3): Collection {
        return Promotion::query()
            ->where('is_active', true)
            ->latest()
            ->take($limit)
            ->get();
    }
}
