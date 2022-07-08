<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:(0)" class="brand-link">
        <img src="{{asset('images/icon/icon-greff.png')}}"  alt="greff Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Greff</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist//img/user2-160x160.jpg')}} " class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name     }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @role('admin')
                <li class="nav-item">
                    <a href="{{route('company.index')}}" class="nav-link">
                        <i class="fa fa-university"></i>
                        <p>Company</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('categoryjob.index')}}" class="nav-link">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <p>Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('skill.index')}}" class="nav-link">
                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                        <p>
                            Skills
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.worker.index')}}" class="nav-link">
                        <i class="fa fa-user"></i>
                        <p>Worker</p>
                    </a>
                </li>
                @endrole

                @role('company')
                <li class="nav-item">
                    <a href="{{route('store.index')}}" class="nav-link">
                        <i class="fa fa-university"></i>
                        <p>Store</p>
                    </a>
                </li>
                @endrole

                @role('store')
                <li class="nav-item">
                    <a href="{{route('occupation.index')}}" class="nav-link">
                        <i class="fa fa-cogs"></i>
                        <p>Occupation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('jobs.index')}}" class="nav-link">
                        <i class="fas fa-briefcase"></i>
                        <p>Jobs</p>
                    </a>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="{{route('admin.logout')}}" class="nav-link">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <p>logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
