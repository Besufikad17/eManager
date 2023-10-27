<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenrator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
       }
    }
}
