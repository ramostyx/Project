<?php

namespace App\Listeners;

use App\Events\JoinGroupEvent;
use App\Notifications\GeneralNotification;
use App\Notifications\JoinGroupNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class JoinGroupEventListener
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
     * @param  \App\Events\JoinGroupEvent  $event
     * @return void
     */
    public function handle(JoinGroupEvent $event)
    {
        $teacher=$event->teacher->user;
        Notification::send($teacher, new GeneralNotification($event->message));
    }
}
