<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('assets/images/users/user-9.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">James Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{route('any', 'index')}}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/customers')}}">
                        <i data-feather="users"></i>
                        <span> Customers </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/partners')}}">
                    <i data-feather="clipboard"></i>
                        <span> Partners </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/products')}}">
                        <i data-feather="activity"></i>
                        <span> Products </span>
                    </a>
                </li>
                @can('manage-user')
                <li>
                    <a href="{{url('admin/users')}}">
                        <i data-feather="users"></i>
                        <span> Users </span>
                    </a>
                </li>
                @endcan
                <li>
                    <a href="{{url('admin/categories')}}">
                        <i data-feather="calendar"></i>
                        <span> Categories </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/cat_attributes')}}">
                        <i data-feather="message-square"></i>
                        <span> Category Attributes </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/quotations')}}">
                        <i data-feather="activity"></i>
                        <span> Quotations </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                        <i data-feather="pocket"></i>
                        <span> Approval List </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{url('admin/approvals/open')}}">Open</a>
                            </li>
                            <li>
                                <a href="{{url('admin/approvals/approve')}}">Approved</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{url('admin/custom_quotations')}}">
                    <i data-feather="aperture"></i>
                        <span>Custom Quotations</span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarLayouts" data-bs-toggle="collapse">
                    <i data-feather="layout"></i>
                        <span>Custom Approval List </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{url('admin/custom_approvals/open')}}">Open</a>
                            </li>
                            <li>
                                <a href="{{url('admin/custom_approvals/approve')}}">Approved</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->