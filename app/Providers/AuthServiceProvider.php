<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\PageContent;
use App\Policies\PageContentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
    protected $policies = [
        PageContent::class => PageContentPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        //
    }
}
