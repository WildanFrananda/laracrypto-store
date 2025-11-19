<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Promotion extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'subtitle', 'event_date', 'link_url', 'details', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'event_date' => 'date',
    ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('promotions')
            ->useFallbackUrl('/images/placeholder.jpg')
            ->useFallbackPath(public_path('/images/placeholder.jpg'))
            ->registerMediaConversions(function (?Media $media = null) {
                $this
                    ->addMediaConversion('banner')
                    ->width(1200)
                    ->height(600)
                    ->format('webp')
                    ->quality(85)
                    ->queued()
                    ->performOnCollections('promotions');

                $this
                    ->addMediaConversion('thumbnail')
                    ->width(400)
                    ->height(200)
                    ->format('webp')
                    ->quality(80)
                    ->queued()
                    ->performOnCollections('promotions');
            });
    }

    public function getImageUrlAttribute(): string {
        return $this->getFirstMediaUrl('promotions', 'banner');
    }

    public function getThumbnailUrlAttribute(): string {
        return $this->getFirstMediaUrl('promotions', 'thumbnail');
    }
}
