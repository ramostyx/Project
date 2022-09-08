<?php

namespace App\Listeners;

use App\Events\vent=AssignmentCreationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignmentCreationEventListener
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
     * @param  \App\Events\vent=AssignmentCreationEvent  $event
     * @return void
     */
    public function handle(vent=AssignmentCreationEvent $event)
    {
        //
    }
}
