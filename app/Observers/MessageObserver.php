<?php

namespace AttendanceSystem\Observers;

use AttendanceSystem\Events\NewMessage;
use AttendanceSystem\Models\Message;

class MessageObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        event(new NewMessage($message->body, $message->to_id, $message->id));
    }
}
