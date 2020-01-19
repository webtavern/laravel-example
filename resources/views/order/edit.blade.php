@extends('layouts.app', ['activePage' => 'order.edit', 'titlePage' => __('Edit order')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('order.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit order') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('order.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                @if($errors->any())
                                    <div class="row justify-content-center">
                                        <div class="col-md-11">
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                                {{$errors->first()}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="row justify-content-center">
                                        <div class="col-md-11">
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                                {{session()->get('success')}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Product') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">

                                            <select class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id" required>
                                                <option value="0">{{ __('Select Product') }}</option>

                                                @foreach($products as $product)

                                                    <option value="{{ $product->id }}" @if($order->product_id) selected @endif> {{ $product->title}} </option>

                                                @endforeach
                                            </select>

                                            @if ($errors->has('product_id'))
                                                <span class="error text-danger">{{ $errors->first('product_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Quantity') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" type="number" min="1" max="5000" value="{{ old('title', $order->quantity) }}" required="true" aria-required="true"/>
                                            @if ($errors->has('quantity'))
                                                <span id="name-error" class="error text-danger">{{ $errors->first('quantity') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Workers') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('workers') ? ' has-danger' : '' }}">
                                            @foreach($workers as $worker)
                                                <div>
                                                    <input class="{{ $errors->has('workers') ? ' is-invalid' : '' }}" name="workers[]" value="{{$worker->id}}" type="checkbox" {{($order->hasWorker($worker->id)) ? 'checked' : ''}}/><p style="display: inline">{{ $worker->name}}</p>
                                                </div>
                                            @endforeach
                                            @if ($errors->has('workers'))
                                                <span id="name-error" class="error text-danger">{{ $errors->first('workers') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
