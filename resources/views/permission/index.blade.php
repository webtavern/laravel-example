@extends('layouts.app', ['activePage' => 'permission.index', 'titlePage' => __('Permission list')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Permission</h4>
                            <p class="card-category">List of Permission</p>
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
                                    <a href="{{ route('permission.create') }}" class="btn btn-sm btn-primary">{{ __('Add permission') }}</a>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Routes</th>
                                        <th>Roles</th>

                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            {{$permission->name}}
                                        </td>
                                        <td>
                                            {{$permission->slug}}
                                        </td>
                                        <td>
                                            {{$permission->routes}}
                                        </td>
                                        <td>
                                            @if($permission->roles)
                                                @foreach($permission->roles as $role)
                                                    {{$role->name.','}}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">

                                            <form action="{{ route('permission.destroy', $permission->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{ route('permission.edit', $permission->id) }}" data-original-title=""
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

