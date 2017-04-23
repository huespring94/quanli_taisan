  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
          <a href="#"> {{Auth::user()->role->name}}</a>
        </div>
      </div>
      </br>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span> {{trans('content.left_bar.generate')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> {{trans('content.left_bar.store')}} </a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> {{trans('content.left_bar.s_faculty')}}</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> {{trans('content.left_bar.s_room')}}</a></li>
          </ul>
        </li>
        <li>
          <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span> {{trans('content.left_bar.message')}}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{!! url('admin/import-store/create') !!}">
            <i class="fa fa-edit"></i> <span> {{trans('content.left_bar.import')}}</span>
          </a>
        </li>
        <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Tài sản</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>{{trans('content.left_bar.store')}}</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
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
            <i class="fa fa-files-o"></i>
            <span> {{trans('content.left_bar.s_faculty')}}</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('import-faculty.index') }}"><i class="fa fa-circle-o"></i> Danh sách TS kho</a></li>
            <li><a href="{!! url('admin/import-faculty/create') !!}"><i class="fa fa-circle-o"></i> Nhập kho</a></li>
            <li><a href="fixed.html"><i class="fa fa-circle-o"></i> Lịch sử nhập</a></li>
            <li><a href="collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Thống kê</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span> {{trans('content.left_bar.s_room')}}</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
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
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li>
          <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
      </ul>
    </section>
  </aside>