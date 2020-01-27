<?php

namespace AttendanceSystem\Providers;

use AttendanceSystem\Models\Message;
use AttendanceSystem\Models\Order;
use AttendanceSystem\Observers\MessageObserver;
use AttendanceSystem\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        Message::observe(MessageObserver::class);
    }
}
