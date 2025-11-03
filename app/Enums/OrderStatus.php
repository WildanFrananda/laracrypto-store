<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: string {
    case PENDING = 'pending';
    case AWAITING_CONFIRMATION = 'awaiting_confirmation';
    case COMPLETED = 'completed';
    case SHIPPED = 'shipped';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';

    public function getColor(): string {
        return match ($this) {
            self::PENDING, self::AWAITING_CONFIRMATION => 'warning',
            self::COMPLETED, self::SHIPPED => 'success',
            self::CANCELLED, self::FAILED => 'danger',
        };
    }
}
