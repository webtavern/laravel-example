<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Models\Message;
use AttendanceSystem\Models\User;
use AttendanceSystem\Models\Order;
use AttendanceSystem\Repositories\MessageRepository;
use AttendanceSystem\Repositories\OrderRepository;
use AttendanceSystem\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $userRepository;
    private $orderRepository;
    private $messageRepository;
    /**
     * Create a new controller instance.
     * @param UserRepository $userRepository
     * @param OrderRepository $orderRepository
     * @param MessageRepository $messageRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository,
                                OrderRepository $orderRepository,
                                MessageRepository $messageRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->messageRepository = $messageRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $current_user = auth()->user()->id;
        $users = $this->userRepository->index();
        $users_count = $users->count();
        $working_users = $this->userRepository->getWorkingUsers();
        $user_tasks = $this->orderRepository->getUsersTasks();
        $working_tasks = $this->orderRepository->getWorkingTasks();
        $last_messages = $this->messageRepository->getLastMessagesByUser($current_user);

        return view('dashboard', [
            'users' => $users,
            'users_count' => $users_count,
            'user_tasks' => $user_tasks,
            'working_users' => $working_users,
            'working_tasks' => $working_tasks,
            'last_messages' => $last_messages
        ]);
    }

}
