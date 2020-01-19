<?php
namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order) {
        $this->model = $order;
    }

    public function getOrderWithUsers() {
        return $this->model->with('users')->get();
    }

    public function store($request, $order) {

        $data = $request->all();

//        dd($data);

        $result = $order->fill($data)->save();

        $users = $request->all()['workers'];

        $order->users()->attach($users);

        return ($result) ? true : false;
    }
}
