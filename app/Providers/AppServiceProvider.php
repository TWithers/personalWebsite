<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Lib\Sdk\Tuya\TuyaConnector::class,
            fn () => new \App\Lib\Sdk\Tuya\TuyaConnector(
                config('services.tuya.clientId'),
                config('services.tuya.clientSecret'),
            )
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
