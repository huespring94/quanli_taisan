<body onload="myFunction()" class="hold-transition skin-blue layout-boxed sidebar-mini">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>TS</b>CĐ</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Quản lý </b>TSCĐ</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <!--class="dropdown-toggle" data-toggle="dropdown"-->
                        @if(Auth::user()->role->name == config('constant.r_admin') || Auth::user()->role->name == config('constant.r_accountant'))
                        <a href="{{url('admin/atrophy-store')}}">
                            <i class="fa fa-bell-o"></i>
                            <span id="messages-expire" class="label label-warning"></span>
                        </a>
                        @elseif (Auth::user()->role->name == config('constant.r_faculty'))
                        <a href="{{url('fac/atrophy-store')}}">
                            <i class="fa fa-bell-o"></i>
                            <span id="messages-expire" class="label label-warning"></span>
                        </a>
                        @elseif (Auth::user()->role->name == config('constant.r_room'))
                        <a href="{{url('roo/atrophy-store')}}">
                            <i class="fa fa-bell-o"></i>
                            <span id="messages-expire" class="label label-warning"></span>
                        </a>
                        @endif
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset(config('path.user').Auth::user()->avatar)}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::user()->firstname}} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset(config('path.user').Auth::user()->avatar)}}" class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::user()->firstname}} {{Auth::user()->lastname}} - {{Auth::user()->role->name}}
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('user/profile')}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
