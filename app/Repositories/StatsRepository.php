<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Repositories\Contracts\StatsRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StatsRepository implements StatsRepositoryInterface {
    public function getNewOrdersCount(): int {
        return Order::query()
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->count();
    }

    public function getNewCustomersCount(): int {
        return User::query()
            ->where('role', 'user')
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->count();
    }

    public function getAverageOrderValue(): float {
        return (float) Order::query()
            ->where('status', 'completed')
            ->avg('total_amount');
    }

    public function getSalesDataForChart(): array {
        $data = Order::query()
            ->where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as aggregate')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $data->pluck('date')->map(fn ($date) => Carbon::parse($date)->format('d M'))->toArray();
        $values = $data->pluck('aggregate')->toArray();

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    public function getTotalRevenue(): float {
        return (float) Order::query()
            ->where('status', 'completed')
            ->sum('total_amount');
    }

    public function getRevenueByMethod(string $method): float {
        return (float) Order::query()
            ->where('status', 'completed')
            ->where('payment_method', $method)
            ->sum('total_amount');
    }

    public function getTotalCryptoRevenue(): float {
        return (float) Order::query()
            ->where('status', 'completed')
            ->where('payment_method', 'crypto')
            ->sum('crypto_amount');
    }

    public function getTopCustomers(int $limit = 5): Collection {
        return User::query()
            ->withCount(['orders' => fn ($query) => $query->where('status', 'completed')])
            ->withSum(['orders' => fn ($query) => $query->where('status', 'completed')], 'total_amount')
            ->orderBy('orders_sum_total_amount', 'desc')
            ->take($limit)
            ->get();
    }

    public function getMostSellingProducts(int $limit = 5): Collection {
        return OrderItem::query()
            ->select(
                'product_variant_id',
                DB::raw('SUM(quantity) as total_quantity_sold')
            )
            ->with('variant.product', 'variant.material')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('product_variant_id')
            ->orderBy('total_quantity_sold', 'desc')
            ->take($limit)
            ->get();
    }
}
