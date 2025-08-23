<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Repositories\Contracts\StatsRepositoryInterface;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget {
    protected static ?string $heading = 'Sales (Last 30 Days)';

    protected static ?int $sort = -1;

    protected int|string|array $columnSpan = 2;

    protected function getData(): array {
        $statsRepository = app(StatsRepositoryInterface::class);
        $salesData = $statsRepository->getSalesDataForChart();

        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => $salesData['values'],
                    'backgroundColor' => 'rgba(217, 119, 6, 0.5)',
                    'borderColor' => 'rgb(217, 119, 6)',
                ],
            ],
            'labels' => $salesData['labels'],
        ];
    }

    protected function getType(): string {
        return 'line';
    }
}
