<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface StatsRepositoryInterface {
    public function getNewOrdersCount(): int;

    public function getNewCustomersCount(): int;

    public function getAverageOrderValue(): float;

    public function getSalesDataForChart(): array;

    public function getTotalRevenue(): float;

    public function getRevenueByMethod(string $method): float;

    public function getTotalCryptoRevenue(): float;

    public function getTopCustomers(int $limit = 5): Collection;

    public function getMostSellingProducts(int $limit = 5): Collection;
}
