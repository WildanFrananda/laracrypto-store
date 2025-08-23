<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\User;
use App\Repositories\Contracts\StatsRepositoryInterface;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopCustomers extends BaseWidget {
    protected static ?string $heading = 'Top Customers';

    protected static ?int $sort = -2;

    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table {
        $statsRepository = app(StatsRepositoryInterface::class);

        return $table
            ->query(
                User::query()
                    ->withCount(['orders' => fn (Builder $query) => $query->where('status', 'completed')])
                    ->withSum(['orders' => fn (Builder $query) => $query->where('status', 'completed')], 'total_amount')
                    ->orderBy('orders_sum_total_amount', 'desc')
                    ->limit(5)
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('orders_count')->label('Total Orders'),
                Tables\Columns\TextColumn::make('orders_sum_total_amount')->label('Total Spent')->money('IDR'),
            ]);
    }
}
