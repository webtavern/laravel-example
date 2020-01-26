<?php
namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Order;
use Carbon\Carbon;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getOrderWithUsers()
    {
        return $this->model->with('users')->get();
    }

    public function getUsersTasks()
    {
        return $this->model->where('closed_at', null)
            ->whereHas('users', function ($query) {
                $query->where('id', '=', auth()->user()->id);
            })
            ->with(['product:id,title', 'in_works' => function ($query) {
                $query->where('user_id', '=', auth()->user()->id);
            }])
           ->get();
    }

    public function getWorkingTasks()
    {
        return $this->model->where('closed_at', null)
            ->with(['product:id,title', 'in_works' => function ($query) {
                $query->where('closed_at', '=', null);
            }])->get();
    }

    public function store($request, $order)
    {
        $data = $request->all();

        $result = $order->fill($data)->save();

        $users = $data['workers'];

        $order->users()->attach($users);

        return ($result) ? true : false;
    }

    public function update($request, $order)
    {
        if ($request->has('closed')) {
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
