<ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span> {{trans('content.left_bar.generate')}}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="{!! url('admin/import-store/create') !!}">
            <i class="fa fa-edit"></i> <span> {{trans('content.left_bar.import')}}</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>{{trans('content.left_bar.store')}}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li class="active"><a href="boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        <li class="treeview {{ areActiveRoutes(['import-faculty.index', 'import-faculty.create']) }}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span> {{trans('content.left_bar.s_faculty')}}</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ areActiveRoutes(['import-faculty.index']) }}"><a href="{{route('import-faculty.index') }}"><i class="fa fa-circle-o"></i> Danh sách TS kho</a></li>
            <li class="{{ areActiveRoutes(['import-faculty.create']) }}"><a href="{!! url('admin/import-faculty/create') !!}"><i class="fa fa-circle-o"></i> Nhập kho</a></li>
            <li><a href="fixed.html"><i class="fa fa-circle-o"></i> Lịch sử nhập</a></li>
            <li><a href="collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Thống kê</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span> {{trans('content.left_bar.s_room')}}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li class="active"><a href="boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span> {{trans('content.left_bar.statistical')}}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
    </li>
</ul>
