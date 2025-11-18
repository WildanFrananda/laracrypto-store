<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    public function registerMediaConversions(?Media $media = null): void {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(500)
            ->format('webp')
            ->quality(85)
            ->sharpen(10)
            ->nonQueued();
    }

    public function getImageUrlAttribute(): string {
        $thumbUrl = $this->getFirstMediaUrl('categories', 'thumb');

        if (empty($thumbUrl) || $thumbUrl === '') {
            $thumbUrl = $this->getFirstMediaUrl('categories');
        }

        return $thumbUrl;
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}
