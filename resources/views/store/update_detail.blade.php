@extends('layouts.template_admin')

@section('title_content')
Nhập chi tiết kho hàng
@stop

@section('home')
<li class="active">Nhập kho</li>
@stop

@section('content')

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Thông tin nhập kho</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mã nhập kho</label>
                        <span class="form-control">
                            {{$storeImport->id}}
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Ngày nhập</label>
                        <span class="form-control">
                            {{$storeImport->date_import}}
                        </span>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kho hàng</label>
                        <span class="form-control">
                            {{$storeImport->store->name}}
                        </span>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Người nhập</label>
                        <span class="form-control">
                            {{$storeImport->user->firstname}} {{ $storeImport->user->lastname}}
                        </span>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
            @if (empty($detailImport))
            <h3 class="box-title">Nhập chi tiết kho hàng</h3>
            @else
            <h3 class="box-title">Chỉnh sửa chi tiết kho hàng</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/update-detail-store', [$detailImport->id]) }}">
                {{ csrf_field() }}
                @include ('store.form')
            </form>

        </div>
    </div>
    <!-- /.tab-pane -->
    <!-- /.tab-content -->
</div>
@stop
