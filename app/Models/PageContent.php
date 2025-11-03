<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PageContent extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'page_slug',
        'narrative',
        'total_orders',
        'active_customers',
        'store_branches',
    ];

    protected $casts = [
        'total_orders' => 'integer',
        'active_customers' => 'integer',
        'store_branches' => 'integer',
    ];
}
