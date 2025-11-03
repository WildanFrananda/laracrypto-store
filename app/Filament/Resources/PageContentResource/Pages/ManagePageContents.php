<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageContentResource\Pages;

use App\Filament\Resources\PageContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePageContents extends ManageRecords {
    protected static string $resource = PageContentResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
