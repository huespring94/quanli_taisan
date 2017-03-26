@include ('layouts.header_lib')
    @yield('header_link')
<!-- =============================================== -->
@include ('layouts.header_admin')
<!-- =============================================== -->
<!--Left bar-->
@include ('layouts.left_bar')
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Boxed Layout
      <small>Blank example to the boxed layout</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Layout</a></li>
      <li class="active">Boxed</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
      @yield ('main-content')
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@extends ('layouts.footer_admin')

