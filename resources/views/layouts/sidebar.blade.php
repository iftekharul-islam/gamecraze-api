<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Gamehub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
{{--                            <span class="right badge badge-danger">New</span>--}}
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ (request()->routeIs('all-game', 'game.create')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->routeIs('all-game', 'game.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Game
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all-game') }}" class="nav-link {{ (request()->routeIs('all-game'))  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All games</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('game.create') }}" class="nav-link {{ (request()->routeIs('game.create'))  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create game</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ (request()->routeIs('all-platform', 'platform.create')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->routeIs('all-platform', 'platform.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Platform
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all-platform') }}" class="nav-link {{ (request()->routeIs('all-platform')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All platform</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('platform.create') }}" class="nav-link {{ (request()->routeIs('platform.create')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create platform</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ (request()->routeIs('all-genre', 'genre.create')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->routeIs('all-genre', 'genre.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Genre
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all-genre') }}" class="nav-link {{ (request()->routeIs('all-genre')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Genre</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('genre.create') }}" class="nav-link {{ (request()->routeIs('genre.create')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Genre</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ (request()->routeIs('diskCondition.all', 'diskCondition.create')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->routeIs('diskCondition.all', 'diskCondition.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Disk Condition
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('diskCondition.all') }}" class="nav-link {{ (request()->routeIs('diskCondition.all')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Disk Conditions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('diskCondition.create') }}" class="nav-link {{ (request()->routeIs('diskCondition.create')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create disk Condition</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ (request()->routeIs('rentPost.all')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->routeIs('rentPost.all')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Rent Posts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('rentPost.all') }}" class="nav-link {{ (request()->routeIs('rentPost.all')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Rent Posts</p>
                            </a>
                        </li>
                    </ul>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>
                            Sign Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>