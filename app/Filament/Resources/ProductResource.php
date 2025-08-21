<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\CheckboxList;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

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
                                ->columns(4),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
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
