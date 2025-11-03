<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PageContentResource\Pages;
use App\Models\PageContent;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class PageContentResource extends Resource {
    protected static ?string $model = PageContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'About Us Page';

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\Section::make('We Are Section')
                    ->schema([
                        Forms\Components\RichEditor::make('narrative')->required(),
                    ]),

                Forms\Components\Section::make('Statistics')
                    ->schema([
                        Forms\Components\TextInput::make('total_orders')->numeric()->required(),
                        Forms\Components\TextInput::make('active_customers')->numeric()->required(),
                        Forms\Components\TextInput::make('store_branches')->numeric()->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Gallery')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery_images')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->panelLayout('grid'),
                    ]),
            ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListPageContents::route('/'),

            'edit' => Pages\EditPageContent::route('/{record}/edit'),
        ];
    }
}
