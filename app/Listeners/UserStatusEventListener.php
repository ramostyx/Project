<?php

namespace App\Listeners;

use App\Events\vent=UserStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserStatusEventListener
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
     * @param  \App\Events\vent=UserStatusEvent  $event
     * @return void
     */
    public function handle(vent=UserStatusEvent $event)
    {
        //
    }
}
