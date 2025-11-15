<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class LogNotificationToQueue implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected array $notificationData;


    /**
     * Create a new job instance.
     * @param array $notificationData
     */
    public function __construct(array $notificationData)
    {
        $this->notificationData = $notificationData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Here, instead of sending an email, we push metadata into a Redis sorted set
        // so we can paginate by timestamp later.
        $now = now()->timestamp;

        // We'll JSON-encode a small payload (e.g. id, subject, sent_at)
        $payload = json_encode([
            'id'       => $this->notificationData['id'],
            'short_id' => $this->notificationData['short_id'],
            'subject'  => $this->notificationData['subject'],
            'sent_at'  => now()->toDateTimeString(),
        ]);

        // Use a sorted set so we can fetch in reverse-chron order and paginate.
        Redis::zadd('notifications:log', $now, $payload);
    }
}
