<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageContentResource\Pages;

use App\Filament\Resources\PageContentResource;
use Filament\Resources\Pages\EditRecord;

class EditPageContent extends EditRecord {
    protected static string $resource = PageContentResource::class;
}
