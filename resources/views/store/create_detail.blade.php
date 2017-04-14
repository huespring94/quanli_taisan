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
    <ul class="nav nav-tabs">
        <li><a href="#tab_1" data-toggle="tab">Nhập file</a></li>
        <li class="active"><a href="#tab_2" data-toggle="tab">Nhập thủ công</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="tab_1">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Blank Box</h3>
                    <div class="form-group pull-right">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">

                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                </div>
                <div class="box-body">
                    The great content goes here
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane active" id="tab_2">
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
                    <h3 class="box-title">Nhập chi tiết kho hàng</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('import-store-detail.store') }}">
                        {{ csrf_field() }}
                        <input type="text" hidden="true" name="import_store_id" value="{{$storeImport->id}}">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Chọn tài sản</label>
                                <div class="col-sm-8">
                                    <select name="stuff_id" class="form-control">
                                        @foreach($stuffs as $stuff)
                                        <option value="{{$stuff->stuff_id}}">{{$stuff->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <div class="input-group-addon">
                                        <i class="fa fa-plus-circle"></i>
                                    </div>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-danger">Tạo mới</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Số lượng</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-database"></i>
                                        </div>
                                        <input type="number" min="1" name="quantity" class="form-control pull-right">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Đơn giá (VND)</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <input type="number" name="price_unit" class="form-control pull-right">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Trạng thái (%)</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-bars"></i>
                                        </div>
                                        <input type="number" max="100" min="1" name="status" class="form-control pull-right">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Nhập chi tiết đơn hàng</button>
                        </div>
                    </form>


                </div>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    @stop
