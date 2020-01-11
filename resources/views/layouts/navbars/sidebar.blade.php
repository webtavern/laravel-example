<div class="sidebar" data-color="orange" data-background-color="white"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="https://creative-tim.com/" class="simple-text logo-normal">
            {{ __('Creative Tim') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
                    <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                    <p>{{ __('Users') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laravelExample">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="material-icons">person</i>
                                <span class="sidebar-normal">{{ __('User profile') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <i class="material-icons">people_alt</i>
                                <span class="sidebar-normal"> {{ __('User Management') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($activePage == 'product.index' || $activePage == 'product.create' || $activePage == 'product.edit') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#products" aria-expanded="false">
                    <i class="material-icons">build</i>
                    <p>{{ __('Products') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="products">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'product.index' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('product.index') }}">
                                <i class="material-icons">assignment</i>
                                <span class="sidebar-normal">{{ __('Product list') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'product.create' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('product.create') }}">
                                <i class="material-icons">add_box</i>
                                <span class="sidebar-normal"> {{ __('Create product') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @role('admin')
            <li class="nav-item {{ ($activePage == 'role.index' || $activePage == 'role.create' || $activePage == 'role.edit') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#roles" aria-expanded="false">
                    <i class="material-icons">face</i>
                    <p>{{ __('Roles') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="roles">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'role.index' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('role.index') }}">
                                <i class="material-icons">assignment</i>
                                <span class="sidebar-normal">{{ __('Roles list') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'role.create' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('role.create') }}">
                                <i class="material-icons">add_box</i>
                                <span class="sidebar-normal"> {{ __('Create role') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($activePage == 'permissions.index' || $activePage == 'permissions.create' || $activePage == 'permissions.edit') ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#permissions" aria-expanded="false">
                    <i class="material-icons">gavel</i>
                    <p>{{ __('Permissions') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="permissions">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'permissions.index' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('permission.index') }}">
                                <i class="material-icons">assignment</i>
                                <span class="sidebar-normal">{{ __('Permissions list') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'permissions.create' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('permission.create') }}">
                                <i class="material-icons">add_box</i>
                                <span class="sidebar-normal"> {{ __('Create permission') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endrole


            <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('table') }}">
                    <i class="material-icons">content_paste</i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>

            <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('typography') }}">
                    <i class="material-icons">library_books</i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('icons') }}">
                    <i class="material-icons">bubble_chart</i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('map') }}">
                    <i class="material-icons">location_ons</i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('notifications') }}">
                    <i class="material-icons">notifications</i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('language') }}">
                    <i class="material-icons">language</i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li>
            <li class="nav-item active-pro{{ $activePage == 'upgrade' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('upgrade') }}">
                    <i class="material-icons">unarchive</i>
                    <p>{{ __('Upgrade to PRO') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>

