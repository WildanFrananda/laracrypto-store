<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        if ($this->app->environment('production') || config('app.force_https') || str_contains(request()->getHost(), 'ngrok')) {
            URL::forceScheme('https');
        }

        if (str_contains(request()->getHost(), 'ngrok-free.app')) {
            $this->app['url']->forceRootUrl(config('app.url'));
        }

        request()->server->set('HTTPS', 'on');
    }
}
