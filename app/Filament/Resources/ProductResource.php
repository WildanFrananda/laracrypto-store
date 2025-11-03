<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Color;
use App\Models\Product;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductResource extends Resource {
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Tabs::make('Product Details')->tabs([
                    Tab::make('Primary Details')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(Product::class, 'slug', ignoreRecord: true),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required(),
                            TextInput::make('base_price')
                                ->required()
                                ->numeric()
                                ->prefix('IDR'),
                            RichEditor::make('description')
                                ->columnSpanFull(),
                        ])->columns(2),

                    Tab::make('Images')
                        ->schema([
                            Repeater::make('images_with_colors')
                                ->schema([
                                    FileUpload::make('image_path')
                                        ->image()
                                        ->directory('product-images')
                                        ->disk('public')
                                        ->visibility('public')
                                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                        ->maxSize(5120) // 5MB
                                        ->imageEditor()
                                        ->hiddenLabel()
                                        ->columnSpan(1),
                                    Select::make('color_id')
                                        ->label('Associated Color')
                                        ->options(function ($get) {
                                            $colorIds = $get('../../colors');
                                            if (empty($colorIds)) {
                                                return [];
                                            }

                                            return Color::whereIn('id', $colorIds)->pluck('name', 'id');
                                        })
                                        ->required()
                                        ->columnSpan(1),
                                    Hidden::make('media_uuid'),
                                    Placeholder::make('existing_image_preview')
                                        ->label('Current Image')
                                        ->content(function ($get) {
                                            $mediaUuid = $get('media_uuid');
                                            if (!$mediaUuid) {
                                                return 'New image upload';
                                            }

                                            $media = Media::where('uuid', $mediaUuid)->first();
                                            if (!$media) {
                                                return 'Image not found';
                                            }

                                            return new HtmlString('<img src="'.$media->getUrl().'" style="max-width: 100px; max-height: 100px;" />');
                                        })
                                        ->visible(fn ($get) => !empty($get('media_uuid')))
                                        ->columnSpan(2),
                                ])
                                ->addActionLabel('Add Image with Color')
                                ->columns(2)
                                ->columnSpanFull()
                                ->defaultItems(0),
                        ]),

                    Tab::make('Variants')
                        ->schema([
                            Repeater::make('variants')
                                ->relationship()
                                ->schema([
                                    Select::make('material_id')
                                        ->relationship('material', 'name')
                                        ->required()
                                        ->distinct()
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                                    TextInput::make('price')
                                        ->label('Variant Price')
                                        ->numeric()
                                        ->required()
                                        ->prefix('IDR'),
                                    TextInput::make('stock')
                                        ->numeric()
                                        ->required()
                                        ->default(0),
                                    TextInput::make('sku')
                                        ->label('SKU (Stock Keeping Unit)')
                                        ->unique(ignoreRecord: true),
                                ])
                                ->columns(4)
                                ->defaultItems(1)
                                ->addActionLabel('Add Another Variant'),
                        ]),

                    Tab::make('Colors')
                        ->schema([
                            CheckboxList::make('colors')
                                ->relationship('colors', 'name')
                                ->columns(4)
                                ->live(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('media')
                    ->collection('products')
                    ->label('Image'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('base_price')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('variants_count')->counts('variants')
                    ->label('Variant Count')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
