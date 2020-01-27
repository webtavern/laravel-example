<?php

namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageRepository extends BaseRepository
{
    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function getLastMessagesByUser($id)
    {
        return DB::table('message as t1')->select(['t1.from_id', 't1.to_id', 't1.body', 't1.status', 't1.created_at',
            DB::raw('(select created_at from message where from_id = t1.from_id and to_id = '.$id.' order by created_at desc limit 1 ) as last_timestamp')])
            ->where(['t1.to_id' => $id])->havingRaw('t1.created_at = last_timestamp')->get();
    }

    public function store($request)
    {
        $this->model->from_id = auth()->user()->id;
        $this->model->to_id = $request->input('to_id');
        $this->model->body = $request->input('message');
        $this->model->status = 0;
        $this->model->save();
    }

    public function updateStatus($request)
    {
        $message = $this->getById($request->input('id'));
        $message->status = 1;
        $message->save();
    }

    public function getHistory($request) {

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

        $change_status = $this->getMessagesByUser($messages, $from, $to);

        $this->updateStatusWithHistory($change_status);

        $output = '';

        foreach ($messages as $message) {
            if ($message->to_id == $from) {


                $output .= "<div class=\"m-container\"><div class=\"message-page-message-chat message-page-message-chat--message-from\">
                              <div class=\"message-page-message-chat--message\">".$message->body."</div>
                              <div class=\"message-page-message-chat--message-info\">                   
                                 
                               </div>
                             </div></div>";

            } else {
                $output .= "<div class=\"m-container\"><div class=\"message-page-message-chat message-page-message-chat--message-to\">
                              <div class=\"message-page-message-chat--message\">".$message->body."</div>
                              <div class=\"message-page-message-chat--message-info\">                    
                                 
                               </div>
                             </div></div>";

            }

        }

        return $output;
    }

    public function updateStatusWithHistory($messages) {
        foreach ($messages as $item) {
            $item->status = 1;
            $item->save();
        }
    }

    public function getMessagesByUser($messages, $from, $to) {
        return $messages->where('from_id', $from)->where('to_id', $to);
    }


}
