<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\CleanCart;
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
    protected $listen = [//danh sách các listener sẽ lắng nghe
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreated::class => [//khi sự kiện phát ra thằng nào sẽ lắng nghe
            CleanCart::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
