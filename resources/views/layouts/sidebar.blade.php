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
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.all') }}" class="nav-link {{ (request()->routeIs('user.all', 'user.show')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all-game') }}" class="nav-link {{ (request()->routeIs('all-game', 'game.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Games
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all-platform') }}" class="nav-link {{ (request()->routeIs('all-platform', 'platform.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Platform
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all-genre') }}" class="nav-link {{ (request()->routeIs('all-genre', 'genre.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Genre
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('diskCondition.all') }}" class="nav-link {{ (request()->routeIs('diskCondition.all', 'diskCondition.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-save"></i>
                        <p>
                            Disk Condition
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('gameMode.all') }}" class="nav-link {{ (request()->routeIs('gameMode.all', 'gameMode.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Game Mode
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rentPost.all') }}" class="nav-link {{ (request()->routeIs('rentPost.all')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Rent Posts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('lend.all') }}" class="nav-link {{ Request()->routeIs('lend.all') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Lend History
                        </p>
                    </a>
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
