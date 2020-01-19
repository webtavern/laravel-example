<?php
namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Order;
use Carbon\Carbon;

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

        $result = $order->fill($data)->save();

        $users = $data['workers'];

        $order->users()->attach($users);

        return ($result) ? true : false;
    }

    public function update($request, $order) {

        if($request->has('closed')) {
            $request->merge(['closed_at' => Carbon::now()]);
        } else {
            $request->merge(['closed_at' => null]);
        }

        $data = $request->all();

        $result = $order->update($data);

        $users = $data['workers'];

        $order->users()->sync($users);

        return ($result) ? true : false;
    }
}
