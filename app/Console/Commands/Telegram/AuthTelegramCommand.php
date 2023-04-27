<?php

namespace App\Console\Commands\Telegram;

use App\EventHandler\TelegramEventHandler;
use danog\MadelineProto\API;
use danog\MadelineProto\Logger;
use danog\MadelineProto\Settings;
use Illuminate\Console\Command;

class AuthTelegramCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = new Settings;
        $settings->getLogger()->setLevel(Logger::LEVEL_ULTRA_VERBOSE);
        TelegramEventHandler::startAndLoop('telegram.session', $settings);
    }
}
