<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\OrderCompleted;

class DecreaseProductVariantStock {
    public function handle(OrderCompleted $event): void {
        foreach ($event->order->items as $item) {
            $item->variant()->decrement('stock', $item->quantity);
        }
    }
}
