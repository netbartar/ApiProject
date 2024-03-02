<?php

namespace App\Providers;

use App\Events\CreateOrderEvent;
use App\Events\NewRegisterEvent;
use App\Listeners\CreateProfileListener;
use App\Listeners\GenerateReportListener;
use App\Listeners\ReduceQntListener;
use App\Listeners\SendEmailListener;
use App\Listeners\WelcomeToUserListener;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Observers\OrderObserver;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
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
        NewRegisterEvent::class => [
            CreateProfileListener::class,
            GenerateReportListener::class,
//            SendEmailListener::class,
            WelcomeToUserListener::class
        ],
        CreateOrderEvent::class => [
            SendEmailListener::class,
            ReduceQntListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Order::observe(OrderObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
