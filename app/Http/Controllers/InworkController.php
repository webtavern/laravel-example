<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Models\Inwork;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InworkController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Request $request) {

       $order_id = $request->order_id;
       $user_id = auth()->user()->id;

       $task = Inwork::where(['order_id' => $order_id, 'user_id' => $user_id, 'closed_at' => null])->first();

        if (!empty($task)) {
            $task->closed_at = Carbon::now();
            $task->save();
            echo 'closed';
            die();
        } else {
            $new_task = new Inwork();
            $new_task->order_id = $order_id;
            $new_task->user_id = $user_id;
            $new_task->opened_at = Carbon::now();
            $new_task->save();
            echo 'opened';
        }
    }
}
