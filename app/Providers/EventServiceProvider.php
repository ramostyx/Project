<?php

namespace App\Providers;

use App\Events\JoinGroupEvent;
use App\Events\JoinGroupResponseEvent;
use App\Events\PostCommentEvent;
use App\Listeners\JoinGroupEventListener;
use App\Listeners\JoinGroupResponseEventListener;
use App\Listeners\PostCommentEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        JoinGroupEvent::class => [
            JoinGroupEventListener::class
        ],
        JoinGroupResponseEvent::class => [
            JoinGroupResponseEventListener::class
        ],
        PostCommentEvent::class => [
            PostCommentEventListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
