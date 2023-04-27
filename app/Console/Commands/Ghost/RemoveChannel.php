<?php

namespace App\Console\Commands\Ghost;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:remove-channel {channel}';

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
        $channel = $this->argument('channel');
        DB::table('channels')->where('username', $channel)
            ->delete();
    }
}
