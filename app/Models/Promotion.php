<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Promotion extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'subtitle', 'event_date', 'link_url', 'details', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'event_date' => 'date',
    ];

    public function getImageUrlAttribute(): string {
        return $this->getFirstMediaUrl('promotions');
    }
}
