@extends('layouts.app', ['activePage' => 'index', 'titlePage' => __('Product list')])

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
                            <div class="table-responsive">

                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Main Image
                                    </th>
                                    <th>
                                        Assembly ID
                                    </th>
                                    <th>
                                        Standart of time
                                    </th>
                                    <th>
                                        Created
                                    </th>
                                    <th>
                                        Updated
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{asset('storage/'.$product->image())}}" style="width: 320px; height: 240px" alt="main image"/>
                                            <img src="/storage/app/public/uploads/R6SOtMTqTebdxcV8Ykqo72LCh0UIQwMmE6N6Nf5f.jpeg">
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
                                        <td>
                                            {{$product->created_at}}
                                        </td>
                                        <td>
                                            {{$product->updated_at}}
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

