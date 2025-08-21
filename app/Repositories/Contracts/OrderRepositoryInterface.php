<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface {
    public function getForUser(User $user, int $perPage = 10): LengthAwarePaginator;
}
