<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
        <a href="{!! url('fac/store-room/create') !!}">
            <i class="fa fa-dashboard"></i> <span>Nhập TS</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="{!! url('fac/store-faculty-list') !!}">
            <i class="fa fa-edit"></i> <span>Danh sách TS khoa</span>
        </a>
    </li>
    <li class="treeview">
        <a href="{!! url('fac/store-room-list') !!}">
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
    <li>
        <a href="">
            <i class="fa fa-th"></i> <span>Yêu cầu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{url('fac/atrophy-store')}}"><i class="fa fa-circle-o"></i> Yêu cầu thanh lí</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Yêu cầu điều chuyển</a></li>
          </ul>
    </li>
    <li class="treeview">
        <a>
            <i class="fa fa-files-o"></i>
            <span>Thống kê</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{url('fac/statis-faculty-year')}}"><i class="fa fa-circle-o"></i>Theo khoa</a></li>
            <li><a href="{{url('fac/statis-room-year')}}"><i class="fa fa-circle-o"></i> Theo phòng</a></li>
          </ul>
    </li>
</ul>