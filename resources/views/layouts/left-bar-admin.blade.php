<ul class="sidebar-menu">
    <li class="header">MENU</li>
    <li class="treeview {{ areActiveRoutes(['import-store.create']) }}"">
        <a href="{!! route('import-store.create') !!}">
            <i class="fa fa-edit"></i> <span> {{trans('content.left_bar.import')}}</span>
        </a>
    </li>
    <li class="treeview {{ areActiveRoutes(['import-faculty.index', 'atrophy-store', 'delete-atrophy-store']) }}">
        <a href="#">
            <i class="fa fa-circle-o"></i>
            <span>Danh sách tài sản</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-database"></i> Kho tổng</a></li>
            <li class="{{ areActiveRoutes(['import-faculty.index'])}}"><a href="{{route('import-faculty.index')}}"><i class="fa fa-archive"></i> Kho khoa</a></li>
            <li><a href=""><i class="fa fa-list-alt"></i> Kho phòng</a></li>
            <li class="{{ areActiveRoutes(['atrophy-store', 'delete-atrophy-store'])}}"><a href="{{route('atrophy-store')}}"><i class="fa fa-list-alt"></i> Hết hạn</a></li>
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
            <i class="fa fa-pie-chart"></i>
            <span> {{trans('content.left_bar.statistical')}}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i>Kho tổng</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Kho khoa</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Kho phòng</a></li>
        </ul>
    </li>
    <li class="treeview {{ areActiveRoutes(['request', 'liquidation', 'request-accept-all']) }}">
        <a href="#">
            <i class="fa fa-trash-o"></i>
            <span> Thanh lí </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ areActiveRoutes(['request', 'request-accept-all']) }}"><a href="{{route('request')}}"><i class="fa fa-circle-o"></i>Yêu cầu thanh lí</a></li>
            <li class="{{ areActiveRoutes(['liquidation']) }}"><a href="{{route('liquidation')}}"><i class="fa fa-circle-o"></i>Danh sách thanh lí</a></li>
        </ul>
    </li>
</ul>
