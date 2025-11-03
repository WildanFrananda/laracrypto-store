<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PageContent;
use App\Repositories\Contracts\PageContentRepositoryInterface;

class PageContentRepository implements PageContentRepositoryInterface {
    public function findBySlug(string $slug): ?PageContent {
        return PageContent::query()
            ->where('page_slug', $slug)
            ->first();
    }
}
