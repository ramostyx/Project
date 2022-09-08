<?php

namespace App\Listeners;

use App\Events\PostCommentEvent;
use App\Notifications\PostCommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PostCommentEventListener
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
     * @param  \App\Events\PostCommentEvent  $event
     * @return void
     */
    public function handle(PostCommentEvent $event)
    {
        Notification::send($event->teacher, new PostCommentNotification($event->student));
    }
}
