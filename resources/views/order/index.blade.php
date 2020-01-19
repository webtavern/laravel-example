@extends('layouts.app', ['activePage' => 'order.index', 'titlePage' => __('Orders list')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Orders</h4>
                            <p class="card-category">List of Orders</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('order.create') }}" class="btn btn-sm btn-primary">{{ __('Add order') }}</a>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Closed At</th>
                                        <th>Workers</th>
                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{$order->id}}
                                        </td>
                                        <td>
                                            {{$order->product->title}}
                                        </td>
                                        <td>
                                            {{$order->quantity}}
                                        </td>
                                        <td>
                                            {{$order->closed_at}}
                                        </td>
                                        <td>
                                            @if($order->users)
                                                @foreach($order->users as $user)
                                                    {{$user->name.','}}
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="td-actions text-right">

                                            <form action="{{ route('order.destroy', $order->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{ route('order.edit', $order->id) }}" data-original-title=""
                                                   title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                        data-original-title="" title=""
                                                        onclick="confirm('{{ __("Are you sure you want to delete this product?") }}') ? this.parentElement.submit() : ''">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

