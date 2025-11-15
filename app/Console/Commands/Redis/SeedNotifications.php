<?php

namespace App\Console\Commands\Redis;

use App\Jobs\LogNotificationToQueue;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:seed-notifications {count=2 : The number of mock notifications to seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Redis with mock notification data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $count = (int) $this->argument('count');

        if ($count < 1) {
            $this->error('The count must be a positive integer.');
            return 1;
        }
        // TODO - check to make sure this is not being run in a PROD environment

        foreach (range(1, $count) as $i) {
            $id = (string) Str::uuid();
            $shortId = substr($id, 0, 8); // like a Git commit hash
            $subject = fake()->randomElement([
                    'New message from system',
                    'Weekly report generated',
                    'Subscription activated',
                    'Security alert: new login',
                    'System maintenance scheduled',
                    'You’ve got mail!',
                    'Welcome aboard!',
                    'Reminder: upcoming task',
                ]) . " [{$shortId}]";

            LogNotificationToQueue::dispatch([
                'id'       => $id,
                'short_id' => $shortId,
                'subject'  => $subject,
            ]);

            $this->info("Dispatched notification with ID {$id}.");
        }

        $this->info("Successfully seeded {$count} mock notifications to Redis.");
        return 0;
    }
}
