<ul class="sidebar-menu">
    <li class="header">MENU</li>
    <li class="treeview {{ areActiveRoutes(['import-store.create']) }}"">
        <a href="{!! route('import-store.create') !!}">
            <i class="fa fa-edit"></i> <span> {{trans('content.left_bar.import')}}</span>
        </a>
    </li>
    <li class="treeview {{ areActiveRoutes(['import-faculty.index']) }}">
        <a href="#">
            <i class="fa fa-circle-o"></i>
            <span>Danh sách tài sản</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-database"></i> Kho tổng</a></li>
            <li class="{{ areActiveRoutes(['import-faculty.index']) }}"><a href="{{route('import-faculty.index')}}"><i class="fa fa-archive"></i> Kho khoa</a></li>
            <li><a href=""><i class="fa fa-list-alt"></i> Kho phòng</a></li>
        </ul>
    </li>
    <li class="treeview {{ areActiveRoutes(['import-faculty.create']) }}">
        <a href="{{route('import-faculty.create') }}">
            <i class="fa fa-newspaper-o"></i>
            <span>Nhập kho khoa</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-list-alt"></i>
            <span> Nhập kho phòng</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span> {{trans('content.left_bar.statistical')}}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i>Kho tổng</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Kho khoa</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Kho phòng</a></li>
        </ul>
    </li>
</ul>
