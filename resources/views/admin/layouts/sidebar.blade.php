<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("dashboard")}}" class="brand-link" style="height:60px ;padding-top: 15px;">
        <img src="/styles/admin/dist/img/logo2.png" alt="Mail" class="brand-image" style="width: 200px; float: none;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="padding-top: 20px;">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route("dashboard")}}" class="nav-link {{areActiveRoutes(['dashboard'])}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link {{areActiveRoutes(['categories.*'])}}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('emails.index')}}" class="nav-link {{areActiveRoutes(['emails.*'])}}">
                        <i class="nav-icon fas fa-at"></i>
                        <p>Email accounts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('mails.index')}}" class="nav-link {{areActiveRoutes(['mails.*'])}}">
                        <i class="nav-icon fas fa-mail-bulk"></i>
                        <p>Send mails</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('settings.index')}}" class="nav-link {{areActiveRoutes(['settings.*'])}}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('videos.index')}}" class="nav-link {{areActiveRoutes(['videos.*'])}}">--}}
                {{--                        <i class="nav-icon fas fa-video"></i>--}}
                {{--                        <p>Videos</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link {{areActiveRoutes(['products.*', "categories.*"])}}">--}}
                {{--                        <i class="nav-icon fas fa-box"></i>--}}
                {{--                        <p>--}}
                {{--                            Products--}}
                {{--                            <i class="right fas fa-angle-left"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{route('categories.index')}}"--}}
                {{--                               class="nav-link" {{areActiveRoutes(['categories.*'])}}>--}}
                {{--                                <i class="fas fa-list-alt nav-icon"></i>--}}
                {{--                                <p>Categories</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{route('products.index')}}" class="nav-link {{areActiveRoutes(['products.*'])}}">--}}
                {{--                                <i class="fas fa-box nav-icon"></i>--}}
                {{--                                <p>Products</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('partners.index')}}" class="nav-link {{areActiveRoutes(['partners.*'])}}">--}}
                {{--                        <i class="nav-icon fas fa-handshake"></i>--}}
                {{--                        <p>Partners</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('translations.index')}}" class="nav-link {{areActiveRoutes(['translations.*'])}}">--}}
                {{--                        <i class="nav-icon fas fa-language"></i>--}}
                {{--                        <p>Translations</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('settings.index')}}" class="nav-link {{areActiveRoutes(['settings.*'])}}">--}}
                {{--                        <i class="nav-icon fas fa-cogs"></i>--}}
                {{--                        <p>Settings</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link {{areActiveRoutes(['places.*', 'cities.*'])}}">--}}
                {{--                        <i class="nav-icon fas fa-map-marker"></i>--}}
                {{--                        <p>--}}
                {{--                            Places--}}
                {{--                            <i class="right fas fa-angle-left"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{route('cities.index')}}" class="nav-link {{areActiveRoutes(['cities.*'])}}">--}}
                {{--                                <i class="fas fa-city nav-icon"></i>--}}
                {{--                                <p>Cities</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{route('places.index')}}" class="nav-link {{areActiveRoutes(['places.*'])}}">--}}
                {{--                                <i class="fas fa-map-marker nav-icon"></i>--}}
                {{--                                <p>Places</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('stores.index')}}" class="nav-link {{areActiveRoutes(['stores.*'])}}">--}}
                {{--                        <i class="nav-icon fas fa-store"></i>--}}
                {{--                        <p>Stores</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('product_details.index')}}"--}}
                {{--                       class="nav-link {{areActiveRoutes(['product_details.*'])}}">--}}
                {{--                        <i class="nav-icon fa fa-info-circle"></i>--}}
                {{--                        <p>Product Details</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
