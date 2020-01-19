<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Http\Requests\OrderRequest;
use AttendanceSystem\Models\Order;
use AttendanceSystem\Models\Product;
use AttendanceSystem\Repositories\OrderRepository;
use AttendanceSystem\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    private $orderRepository;
    private $userRepository;

    public function __construct(OrderRepository $orderRepository,
                                UserRepository $userRepository)
    {
        parent::__construct();
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->getOrderWithUsers();

        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_list = Product::select(['id','title'])->get();

        $workers_list = $this->userRepository->getWorkers();

        return view('order.create', ['products' => $product_list, 'workers' => $workers_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderRequest  $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, Order $order)
    {
        $result = $this->orderRepository->store($request, $order);

        if($result) {
            return redirect()->route('order.index')->with(['success' => "Успешно сохранено"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->getById($id);

        $product_list = Product::select(['id','title'])->get();

        $workers_list = $this->userRepository->getWorkers();

        return view('order.edit', [
            'order' => $order,
            'products' => $product_list,
            'workers' => $workers_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
