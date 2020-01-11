@extends('layouts.app', ['activePage' => 'role.index', 'titlePage' => __('Roles list')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Roles</h4>
                            <p class="card-category">List of Roles</p>
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
                                    <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary">{{ __('Add role') }}</a>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Permissions</th>
                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            {{$role->name}}
                                        </td>
                                        <td>
                                            {{$role->slug}}
                                        </td>
                                        <td>
                                            @if($role->permissions)
                                                @foreach($role->permissions as $permission)
                                                    {{$permission->name.','}}
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="td-actions text-right">

                                            <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{ route('role.edit', $role->id) }}" data-original-title=""
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

