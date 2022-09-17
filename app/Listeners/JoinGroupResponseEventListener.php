<?php

namespace App\Listeners;

use App\Events\JoinGroupResponseEvent;
use App\Notifications\GeneralNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class JoinGroupResponseEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\JoinGroupResponseEvent  $event
     * @return void
     */
    public function handle(JoinGroupResponseEvent $event)
    {
        Notification::send($event->student, new GeneralNotification($event->response));
    }
}
