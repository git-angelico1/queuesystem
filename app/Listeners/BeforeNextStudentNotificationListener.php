<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BeforeNextStudentNotification;

class BeforeNextStudentNotificationListener
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
    public function handle(BeforeNextStudentNotification $event)
    {
        logger('Event triggered!', ['nextStudent' => $event->nextStudent]);
        // Handle the notification logic before deleting the student
    }
}
