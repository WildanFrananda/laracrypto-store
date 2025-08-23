<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use App\Repositories\Contracts\StatsRepositoryInterface;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MostSellingProducts extends BaseWidget {
    protected static ?string $heading = 'Most Selling Products';

    protected static ?int $sort = -2;

    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table {
        $statsRepository = app(StatsRepositoryInterface::class);

        return $table
            ->query(
                OrderItem::query()
                    ->select(
                        'product_variant_id',
                        DB::raw('SUM(quantity) as total_quantity_sold')
                    )
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', 'completed')
                    ->groupBy('product_variant_id')
                    ->orderBy('total_quantity_sold', 'desc')
                    ->limit(5)
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('variant.product.name')->label('Product'),
                Tables\Columns\TextColumn::make('variant.material.name')->label('Material'),
                Tables\Columns\TextColumn::make('total_quantity_sold')->label('Quantity Sold'),
            ]);
    }

    public function getTableRecordKey(Model $record): string {
        return (string) $record->product_variant_id;
    }
}
