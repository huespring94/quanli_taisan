<!-- =============================================== -->

<!--Header-->
@include ('layouts.header_lib')
    @yield('header_link')
@include ('layouts.header_admin')

<!-- =============================================== -->

<!--Left bar-->
@include ('layouts.left_bar')

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>@yield('title_content')
      <small>@yield('title_des')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      @yield('home')
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
      @yield ('content')
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- =============================================== -->

<!--Footer-->
@include ('layouts.footer_admin')
@include ('layouts.footer_lib')
