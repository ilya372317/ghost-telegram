<?php

namespace App\Providers;

use App\Services\Ghost\GhostClient;
use App\Services\Ghost\GhostClientService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @pakege App\Providers
 *
 * @author Otinov Ilya
 */
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


        Http::macro('ghost', function () {
            return Http::baseUrl('https://onff.ru/ghost/api/v2/admin');
        });
    }
}
