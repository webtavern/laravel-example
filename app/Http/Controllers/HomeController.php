<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Models\User;
use AttendanceSystem\Models\Order;
use AttendanceSystem\Repositories\OrderRepository;
use AttendanceSystem\Repositories\UserRepository;

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
        $users_count = $this->userRepository->getAllCount();
        $working_users = $this->userRepository->getWorkingUsers();
        $user_tasks = $this->orderRepository->getUsersTasks();
        $working_tasks = $this->orderRepository->getWorkingTasks();

        return view('dashboard', [
            'users_count' => $users_count,
            'user_tasks' => $user_tasks,
            'working_users' => $working_users,
            'working_tasks' => $working_tasks
        ]);
    }

    public function refreshUsers() {

    }

    public function refreshOrders() {

    }
}
