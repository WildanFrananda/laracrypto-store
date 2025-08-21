<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PromotionRepositoryInterface {
    public function getActivePromotions(int $limit = 3): Collection;
}
