<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget {
    protected int|string|array $columnSpan = 2;

    public function table(Table $table): Table {
        return $table
            ->query(OrderResource::getEloquentQuery()->latest()->limit(5))
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('order_number'),
                Tables\Columns\TextColumn::make('user.name')->label('Customer'),
                Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (OrderStatus $state): string => $state->getColor()),
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->url(fn ($record): string => OrderResource::getUrl('view', ['record' => $record])),
            ]);
    }
}
