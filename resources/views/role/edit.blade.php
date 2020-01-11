@extends('layouts.app', ['activePage' => 'role.edit', 'titlePage' => __('Edit role')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="{{ route('role.update', $role->id) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('patch')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit role') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('role.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', $role->name) }}" required="true" aria-required="true"/>
                                            @if ($errors->has('name'))
                                                <span id="title-error" class="error text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Slug') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" type="text" placeholder="{{ __('Slug') }}" value="{{ old('slug', $role->slug) }}" required="true" aria-required="true"/>
                                            @if ($errors->has('slug'))
                                                <span id="name-error" class="error text-danger">{{ $errors->first('slug') }}</span>
                                            @endif
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


