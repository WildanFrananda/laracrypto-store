<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model {
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'description', 'base_price'];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany {
        return $this->hasMany(ProductVariant::class);
    }

    public function colors(): BelongsToMany {
        return $this->belongsToMany(Color::class, 'product_color');
    }

    public function wishlistedBy(): BelongsToMany {
        return $this->belongsToMany(User::class, 'wishlist');
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }
}
