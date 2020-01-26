<?php

namespace AttendanceSystem\Observers;

use AttendanceSystem\Models\Order;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \AttendanceSystem\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        dd($order);
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \AttendanceSystem\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \AttendanceSystem\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \AttendanceSystem\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \AttendanceSystem\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
