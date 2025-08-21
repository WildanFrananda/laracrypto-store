<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model {
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory;

    protected $fillable = ['product_id', 'material_id', 'price', 'stock', 'sku'];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function material(): BelongsTo {
        return $this->belongsTo(Material::class);
    }
}
