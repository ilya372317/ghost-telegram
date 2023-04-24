<?php

namespace App\Providers;

use App\Services\Ghost\GhostClient;
use App\Services\Ghost\GhostClientService;
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
        $this->app->bind(GhostClient::class, GhostClientService::class);
    }
}
