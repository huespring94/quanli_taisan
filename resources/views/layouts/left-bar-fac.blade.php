<ul class="sidebar-menu">
    <li class="header">MENU</li>
    <li class="treeview {{ areActiveRoutes(['store-room.create', 'store-room.store']) }}">
        <a href="{!! route('store-room.create') !!}">
            <i class="fa fa-plus-square-o"></i> <span>Nhập TS</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li class="{{ areActiveRoutes(['store-faculty-list', 'detail-store-faculty']) }}">
        <a href="{!! route('store-faculty-list') !!}">
            <i class="fa fa-list-alt"></i> <span>Danh sách TS khoa</span>
        </a>
    </li>
    <li class="treeview {{ areActiveRoutes(['store-room-list', 'store-room-fac', 'store-room.show']) }}">
        <a href="{!! route('store-room-list') !!}">
            <i class="fa fa-list-ul"></i> <span>Danh sách TS phòng</span>
        </a>
    </li>
    <li class="{{ areActiveRoutes(['liquidation-faculty']) }}">
        <a href="{{route('liquidation-faculty')}}">
            <i class="fa fa-list-ol"></i> <span>Danh sách TS thanh lí</span>
        </a>
    </li>
    <li class="{{ areActiveRoutes(['atrophy-store-faculty', 'request-liquidation-faculty']) }}">
        <a href="{{route('atrophy-store-faculty')}}">
            <i class="fa fa-send-o"></i> <span>Yêu cầu thanh lí</span>
        </a>
    </li>
    <li class="treeview {{ areActiveRoutes(['statis-faculty-year', 'statis-room-year', 'statis-faculty-by-year', 'statis-by-room-year']) }}">
        <a>
            <i class="fa fa-pie-chart"></i>
            <span>Thống kê</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ areActiveRoutes(['statis-faculty-year', 'statis-faculty-by-year']) }}"><a href="{{route('statis-faculty-year')}}"><i class="fa fa-circle-o"></i>Theo khoa</a></li>
            <li class="{{ areActiveRoutes(['statis-room-year', 'statis-by-room-year']) }}"><a href="{{route('statis-room-year')}}"><i class="fa fa-circle-o"></i> Theo phòng</a></li>
          </ul>
    </li>
</ul>