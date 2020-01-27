@extends('layouts.app', ['activePage' => 'product.index', 'titlePage' => __('Product list')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Product</h4>
                            <p class="card-category">List of Product</p>
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
                                <div class="col-12 text-right">
                                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">{{ __('Add product') }}</a>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Assembly ID</th>
                                        <th>Standart of time(h)</th>
                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{asset($product->getThumb())}}" style="width: 320px; height: 240px" alt="main_image"/>
                                        </td>
                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}">{{$product->title}}</a>
                                        </td>
                                        <td>
                                            {{$product->description}}
                                        </td>
                                        <td>
                                            {{$product->assembly_id}}
                                        </td>
                                        <td>
                                            {{$product->standart_of_time}}
                                        </td>
                                        <td class="td-actions text-right">

                                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{ route('product.edit', $product->id) }}" data-original-title=""
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

