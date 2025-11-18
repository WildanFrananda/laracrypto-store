<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['category_id', 'name', 'slug', 'description', 'base_price'];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('products')
            ->useFallbackUrl('/images/placeholder.jpg')
            ->useFallbackPath(public_path('/images/placeholder.jpg'))
            ->registerMediaConversions(function (?Media $media = null) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(400)
                    ->height(500)
                    ->format('webp')
                    ->quality(85)
                    ->sharpen(10)
                    ->nonQueued() // Generate immediately
                    ->performOnCollections('products');

                $this
                    ->addMediaConversion('catalog')
                    ->width(300)
                    ->height(375)
                    ->format('webp')
                    ->quality(80)
                    ->nonQueued()
                    ->performOnCollections('products');

                $this
                    ->addMediaConversion('detail')
                    ->width(800)
                    ->height(1000)
                    ->format('webp')
                    ->quality(90)
                    ->performOnCollections('products');
            });
    }

    public function getImageUrlAttribute(): string {
        return $this->getFirstMediaUrl('products', 'catalog');
    }

    public function getThumbUrlAttribute(): string {
        return $this->getFirstMediaUrl('products', 'thumb');
    }

    public function getDetailImageUrlAttribute(): string {
        return $this->getFirstMediaUrl('products', 'detail');
    }

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
