<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Events\NewMessage;
use AttendanceSystem\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function send(Request $request)
    {
        $message = new Message();
        $message->from_id = auth()->user()->id;
        $message->to_id = $request->input('to_id');
        $message->body = $request->input('message');
        $message->status = 0;
        $message->save();

        event(new NewMessage($request->input('message'), $request->input('to_id'), $message->id));

        die();
    }

    public function switchStatus(Request $request)
    {

        $message = Message::find($request->input('id'));
        $message->status = 1;
        $message->save();
        die();

    }

    public function getHistory(Request $request)
    {
        $from = $request->input('from_id');
        $to = $request->input('to_id');

        $messages = Message::where(
            function ($q) use ($from, $to) {
                $q->where(['from_id' => $from])
                    ->where(['to_id' => $to]);
            })->orWhere(function ($q) use ($from, $to) {
            $q->where(['from_id' => $to])
                ->where(['to_id' => $from]);
        })->orderBy('created_at')->get();

        $change_status = $messages->where('from_id', $from)->where('to_id', $to);

        foreach ($change_status as $item) {
            $item->status = 1;
            $item->save();
        }

        $output = '';

        foreach ($messages as $message) {
            if ($message->to_id == $from) {


                $output .= "<div class=\"m-container\"><div class=\"message-page__message-chat message-page__message-chat--message-from\">
                              <div class=\"message-page__message-chat--message\">".$message->body."</div>
                              <div class=\"message-page__message-chat--message-info\">                   
                                 
                               </div>
                             </div></div>";

            } else {
                $output .= "<div class=\"m-container\"><div class=\"message-page__message-chat message-page__message-chat--message-to\">
                              <div class=\"message-page__message-chat--message\">".$message->body."</div>
                              <div class=\"message-page__message-chat--message-info\">                    
                                 
                               </div>
                             </div></div>";

            }

        }

        echo $output;

        die();
    }
}
