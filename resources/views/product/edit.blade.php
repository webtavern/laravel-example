@extends('layouts.app', ['activePage' => 'product.edit', 'titlePage' => __('Edit product')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="{{ route('product.update', $product->id) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit product') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                                    <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Title') }}" value="{{ old('title', $product->title) }}" required="true" aria-required="true"/>
                                            @if ($errors->has('title'))
                                                <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Description') }}" value="{{ old('description', $product->description) }}" required="true" aria-required="true"/>
                                            @if ($errors->has('description'))
                                                <span id="name-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Assembly') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('assembly_id') ? ' has-danger' : '' }}">

                                            <select class="form-control{{ $errors->has('assembly_id') ? ' is-invalid' : '' }}" name="assembly_id" id="input-assembly_id" >
                                                <option value="">{{ __('Select Assembly') }}</option>

                                                @foreach($assemblyList as $key => $value)

                                                    @if($key !== $product->id)
                                                        <option value="{{ $key }}" @if($key === $product->assembly_id) selected @endif>
                                                            {{$value}}
                                                        </option>
                                                    @endif

                                                @endforeach
                                            </select>

                                            @if ($errors->has('assembly_id'))
                                                <span id="assembly_id-error" class="error text-danger" for="input-assembly_id">{{ $errors->first('assembly_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Standart of time') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('standart_of_time') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('standart_of_time') ? ' is-invalid' : '' }}" name="standart_of_time" id="input-standart_of_time" type="text" placeholder="{{ __('Enter the time(h)') }}" value="{{ old('standart_of_time', $product->standart_of_time) }}" required="true" aria-required="true"/>
                                            @if ($errors->has('standart_of_time'))
                                                <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('standart_of_time') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Is assembly?') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('is_assembly') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('is_assembly') ? ' is-invalid' : '' }}" name="is_assembly" id="input-is_assembly" type="checkbox" value="1" style="width: 36px" {{ ($product->is_assembly == 1) ? 'checked' : '' }}/>
                                            @if ($errors->has('is_assembly'))
                                                <span id="title-error" class="error text-danger" for="is_assembly">{{ $errors->first('is_assembly') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Images') }}</label>
                                    <div class="col-sm-7">
                                        <div>
                                            <input name="images[]" id="input-images" type="file" multiple/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Confirm changes') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

