<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Contracts\DeliveryBoyRepositoryContract::class, \App\Repositories\DeliveryBoyRepository::class);
        $this->app->bind(\App\Contracts\OrderRepositoryContract::class, \App\Repositories\OrderRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
