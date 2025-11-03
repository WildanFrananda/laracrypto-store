<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\PageContent;

interface PageContentRepositoryInterface {
    public function findBySlug(string $slug): ?PageContent;
}
