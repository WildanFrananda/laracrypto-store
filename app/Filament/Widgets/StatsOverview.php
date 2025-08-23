<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Repositories\Contracts\StatsRepositoryInterface;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget {
    protected static ?int $sort = -3;

    protected function getStats(): array {
        $statsRepository = app(StatsRepositoryInterface::class);

        return [
            Stat::make('Total Revenue', 'IDR '.number_format($statsRepository->getTotalRevenue(), 0, ',', '.'))
                ->description('Total Revenue from completed orders.')
                ->color('success'),

            Stat::make('Midtrans Revenue', 'IDR '.number_format($statsRepository->getRevenueByMethod('midtrans'), 0, ',', '.'))
                ->description('Total Revenue from Midtrans.'),

            Stat::make('Crypto Revenue (ETH)', number_format($statsRepository->getTotalCryptoRevenue(), 8).' ETH')
                ->description('Total Revenue from Crypto.'),
            Stat::make('New Orders (Last 30 Days)', $statsRepository->getNewOrdersCount())
                ->description('Total Orders from the last 30 days.')
                ->color('success')
                ->icon('heroicon-o-shopping-cart'),

            Stat::make('New Customers (Last 30 Days)', $statsRepository->getNewCustomersCount())
                ->description('Total Customers from the last 30 days.')
                ->color('success')
                ->icon('heroicon-o-user-plus'),

            Stat::make('Average Order Value', 'IDR '.number_format($statsRepository->getAverageOrderValue(), 0, ',', '.'))
                ->description('Average value of completed orders.')
                ->color('success')
                ->icon('heroicon-o-banknotes'),
        ];
    }
}
