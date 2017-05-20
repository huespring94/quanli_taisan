<ul class="sidebar-menu">
    <li class="header">MENU</li>
    <li class="treeview {{ areActiveRoutes(['store-room-user']) }}">
        <a href="{{route('store-room-user')}}">
            <i class="fa fa-th"></i> <span>Danh sách TS phòng</span>
        </a>
    </li>
    <li class="treeview {{ areActiveRoutes(['liquidation-room']) }}">
        <a href="{{route('liquidation-room')}}">
            <i class="fa fa-th"></i> <span>Danh sách TS thanh lí</span>
        </a>
    </li>
    <li class="{{ areActiveRoutes(['atrophy-store-room', 'request-liquidation-room']) }}">
        <a href="{{route('atrophy-store-room')}}">
            <i class="fa fa-safari"></i> <span>Yêu cầu thanh lí</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li class="treeview {{ areActiveRoutes(['room-statistic'])}}">
        <a href="{{route('room-statistic')}}">
            <i class="fa fa-pie-chart"></i>
            <span>Thống kê</span>
        </a>
    </li>
</ul>