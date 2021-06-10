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
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
                    <a href="{{ route('area.all') }}" class="nav-link {{ (request()->routeIs('area.all', 'area.show')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Locations
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
                    <a href="{{ route('checkpoint.all') }}" class="nav-link {{ (request()->routeIs('checkpoint.all', 'checkpoint.show')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-thumbtack"></i>
                        <p>
                            Checkpoint
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
                    <a href="{{ route('all-article') }}" class="nav-link {{ (request()->routeIs('all-article')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            News and articles
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
                    <a href="{{ route('basePrice.all') }}" class="nav-link {{ (request()->routeIs('basePrice.all', 'basePrice.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Base price
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('coupon') }}" class="nav-link {{ (request()->routeIs('coupon', 'coupon.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Coupon
                        </p>
                    </a>
                </li>

                <li class="nav-item">

                    <a href="{{ route('deliveryCharge.all') }}" class="nav-link {{ (request()->routeIs('deliveryCharge.all', 'deliveryCharge.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Delivery Charges
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('video.all') }}" class="nav-link {{ (request()->routeIs('video.all', 'video.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-film"></i>
                        <p>
                            Featured Videos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cover.all') }}" class="nav-link {{ (request()->routeIs('cover.all', 'cover.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-film"></i>
                        <p>
                            Cover Images
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('extend.request') }}" class="nav-link {{ (request()->routeIs('extend.request', 'extend.request.approve', 'extend.request.reject')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Extend Requests
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rentPost.all') }}" class="nav-link {{ (request()->routeIs('rentPost.all')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Lend Posts
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('lend.all') }}" class="nav-link {{ Request()->routeIs('lend.all') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Rent History
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.all') }}" class="nav-link {{ Request()->routeIs('orders.all') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaction.history') }}" class="nav-link {{ Request()->routeIs('transaction.history') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Transaction history
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('referral.history') }}" class="nav-link {{ Request()->routeIs('referral.history') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Referral history
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wallet.history') }}" class="nav-link {{ Request()->routeIs('wallet.history') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Wallet spend history
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notice') }}" class="nav-link {{ Request()->routeIs('notice') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                           Notice board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('meta') }}" class="nav-link {{ Request()->routeIs('meta') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Meta
                        </p>
                    </a>
                </li>
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">Game Bazar</a>
                    </div>
                </div>
                <li class="nav-item">
                    <a href="{{ route('category') }}" class="nav-link {{ Request()->routeIs('category') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Category
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
