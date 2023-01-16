<?php

namespace App\Providers;

use App\Events\Center\CenterSaveEvent;
use App\Events\Center\CenterUpdateEvent;
use App\Events\Meeting\RegisterMeetingEvent;
use App\Events\Comment\RegisterCommentEvent;
use App\Events\Event\RegisterEventRecordEvent;
use App\Events\User\SignUpEvent;
use App\Listeners\Center\CenterMakeAdminRoleListener;
use App\Listeners\Center\CenterSyncAdminRoleListener;
use App\Listeners\Center\CenterDetachOldAdminRoleListener;
use App\Listeners\Meeting\SendSMSNotificationToMeetingUsersListener;
use App\Listeners\Meeting\SendMessageToMeetingUsersListener;
use App\Listeners\Comment\SendMessageToCommentUsersListener;
use App\Listeners\Event\SendMessageToEventUsersListener;
use App\Listeners\User\SendActivationEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        CenterSaveEvent::class => [
            CenterMakeAdminRoleListener::class,
            CenterSyncAdminRoleListener::class,
        ],
        CenterUpdateEvent::class => [
            CenterMakeAdminRoleListener::class,
            CenterDetachOldAdminRoleListener::class,
            CenterSyncAdminRoleListener::class,
        ],
        SignUpEvent::class => [
            SendActivationEmailListener::class,
        ],
        RegisterMeetingEvent::class => [
            SendSMSNotificationToMeetingUsersListener::class,
            SendMessageToMeetingUsersListener::class,
        ],
        RegisterEventRecordEvent::class => [
            SendMessageToEventUsersListener::class,
        ],
        RegisterCommentEvent::class => [
            SendMessageToCommentUsersListener::class,
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
}
