<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Models\Message;
use AttendanceSystem\Models\User;
use AttendanceSystem\Models\Order;
use AttendanceSystem\Repositories\OrderRepository;
use AttendanceSystem\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $userRepository;
    private $orderRepository;
    /**
     * Create a new controller instance.
     * @param UserRepository $userRepository
     * @param OrderRepository $orderRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository, OrderRepository $orderRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userRepository->index();
        $users_count = $users->count();
        $working_users = $this->userRepository->getWorkingUsers();
        $user_tasks = $this->orderRepository->getUsersTasks();
        $working_tasks = $this->orderRepository->getWorkingTasks();
        $last_messages = DB::table('message as t1')->select(['t1.from_id', 't1.to_id', 't1.body', 't1.status', 't1.created_at',
            DB::raw('(select created_at from message where from_id = t1.from_id order by created_at desc limit 1 ) as last_timestamp')])
            ->where(['t1.to_id' => auth()->user()->id])->havingRaw('t1.created_at = last_timestamp')->get();

        return view('dashboard', [
            'users' => $users,
            'users_count' => $users_count,
            'user_tasks' => $user_tasks,
            'working_users' => $working_users,
            'working_tasks' => $working_tasks,
            'last_messages' => $last_messages
        ]);
    }

    public function refreshUsers() {
        // to observer
    }

    public function refreshOrders() {
        // to observer
    }
}
