<?php

namespace App\Console\Commands\Redis;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ClearNotifications extends Command
{
    protected $signature = 'redis:clear-notifications';
    protected $description = 'Delete all notifications from Redis sorted set';

    public function handle(): int
    {
        $key = 'notifications:log'; // Could pass this in as an argument if you want it dynamic.

        if (! $this->confirm("Are you sure you want to delete all Redis notifications?", false)) {
            return 1;
        }
        // TODO - check to make sure this is not being run in a PROD environment

        if (Redis::exists($key)) {
            Redis::del($key);
            $this->info("Deleted Redis key: {$key}");
        } else {
            $this->warn("Redis key '{$key}' does not exist.");
        }

        return 0;
    }
}

