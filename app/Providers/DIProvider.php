<?php

namespace App\Providers;

use App\Http\Controllers\Channel\ChannelController;
use App\Repository\Channel\ChannelRepository;
use App\Repository\Channel\DatabaseChannelRepository;
use App\Services\Channel\ChannelService;
use App\Services\Channel\DefaultChannelService;
use Illuminate\Support\ServiceProvider;

/**
 * Class DIProvider
 * @pakege App\Providers
 *
 * @author Otinov Ilya
 */
class DIProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->when(ChannelController::class)
            ->needs(ChannelService::class)
            ->give(DefaultChannelService::class);
        $this->app->when(DefaultChannelService::class)
            ->needs(ChannelRepository::class)
            ->give(DatabaseChannelRepository::class);
    }
}
