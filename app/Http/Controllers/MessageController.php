<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Events\NewMessage;
use AttendanceSystem\Models\Message;
use AttendanceSystem\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        parent::__construct();
        $this->messageRepository = $messageRepository;
    }

    public function send(Request $request)
    {
        $this->messageRepository->store($request);
        die();
    }

    public function updateStatus(Request $request)
    {
        $this->messageRepository->updateStatus($request);
        die();
    }

    public function getHistory(Request $request)
    {
       $output = $this->messageRepository->getHistory($request);
        echo $output;
        die();
    }
}
