<?php

declare(strict_types=1);

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutUsSettings extends Settings {
    public string $narrative = '';

    public int $total_orders = 0;

    public int $active_customers = 0;

    public int $store_branches = 0;

    public array $gallery_images = [];

    public static function group(): string {
        return 'about_us';
    }
}
