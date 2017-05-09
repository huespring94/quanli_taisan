<ul class="sidebar-menu">
    <li class="header">MENU</li>
    <li class="treeview {{ areActiveRoutes(['store-room.create', 'store-room.store']) }}">
        <a href="{!! route('store-room.create') !!}">
            <i class="fa fa-dashboard"></i> <span>Nhập TS</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li class="{{ areActiveRoutes(['store-faculty-list']) }}">
        <a href="{!! route('store-faculty-list') !!}">
            <i class="fa fa-edit"></i> <span>Danh sách TS khoa</span>
        </a>
    </li>
    <li class="treeview {{ areActiveRoutes(['store-room-list', 'store-room-fac', 'store-room.show']) }}">
        <a href="{!! route('store-room-list') !!}">
            <i class="fa fa-edit"></i> <span>Danh sách TS phòng</span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="fa fa-th"></i> <span>Danh sách TS thanh lí</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li class="{{ areActiveRoutes(['atrophy-store-faculty', 'request-liquidation-faculty']) }}">
        <a>
            <i class="fa fa-th"></i> <span>Yêu cầu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ areActiveRoutes(['atrophy-store-faculty']) }}"><a href="{{route('atrophy-store-faculty')}}"><i class="fa fa-circle-o"></i> Yêu cầu thanh lí</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Yêu cầu điều chuyển</a></li>
          </ul>
    </li>
    <li class="treeview {{ areActiveRoutes(['statis-faculty-year', 'statis-room-year', 'statis-faculty-by-year', 'statis-by-room-year']) }}">
        <a>
            <i class="fa fa-files-o"></i>
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