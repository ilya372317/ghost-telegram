<?php

namespace App\Console\Commands\Ghost;

use App\Models\Channel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:add-channel {channel}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add new channel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $channel = $this->argument('channel');
        $myChannel = new Channel();
        $myChannel->username = $channel;
        $myChannel->save();
    }
}
