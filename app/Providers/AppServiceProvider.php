<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Add this import

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Force HTTPS for all generated URLs when in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
