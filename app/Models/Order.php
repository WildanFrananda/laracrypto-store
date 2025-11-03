<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model {
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'crypto_amount',
        'status',
        'payment_method',
        'transaction_hash',
        'shipping_recipient_name',
        'shipping_phone_number',
        'shipping_full_address',
        'shipping_city',
        'shipping_province',
        'shipping_postal_code',
    ];

    protected $casts = [
        'total_amount' => 'float',
        'crypto_amount' => 'float',
        'status' => OrderStatus::class,
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class);
    }
}
