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
//        dd($order);
        // notification event
    }


}
