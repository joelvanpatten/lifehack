<?php

namespace App\Console\Commands\Redis;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ListNotifications extends Command
{
    protected $signature = 'redis:list-notifications {--limit=40 : Number of notifications to retrieve}';
    protected $description = 'List notifications stored in Redis sorted set';

    public function handle(): int
    {
        $limit = (int) $this->option('limit');

        if ($limit < 1) {
            $this->error('The limit must be a positive integer.');
            return 1;
        }

        // Fetch notifications in reverse chronological order
        $notifications = Redis::zrevrange('notifications:log', 0, $limit - 1, ['withscores' => true]);

        if (empty($notifications)) {
            $this->info('No notifications found in Redis.');
            return 0;
        }

        $this->table(
            ['ID', 'Short ID', 'Subject', 'Sent At', 'Timestamp'],
            collect($notifications)->map(function ($score, $payload) {
                $data = json_decode($payload, true);
                return [
                    $data['id'] ?? 'N/A',
                    $data['short_id'] ?? 'N/A',
                    $data['subject'] ?? 'N/A',
                    $data['sent_at'] ?? 'N/A',
                    $score, // Timestamp
                ];
            })->toArray()
        );

        $this->info("Retrieved up to {$limit} notifications from Redis.");
        return 0;
    }
}
