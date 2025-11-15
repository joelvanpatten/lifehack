<?php

namespace App\Listeners;

use App\Jobs\LogNotificationToQueue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class HandleUserRegistration
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;
        $this->LogUserRegisteredNotification($user);

        # Other jobs you might want to dispatch:
        // SendWelcomeEmail::dispatch($user);
        // TrackUserSignupInAnalytics::dispatch($user->id);
    }

    /**
     * @param $user
     */
    private function LogUserRegisteredNotification($user): void
    {
        $id = (string)Str::uuid();
        $shortId = substr($id, 0, 8); // like a Git commit hash

        LogNotificationToQueue::dispatch([
            'id' => $id,
            'short_id' => $shortId,
            'subject' => "New User Registration: {$user->name} ({$user->id})",
        ]);
    }
}
