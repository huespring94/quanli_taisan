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
                    
                    
                    
                    
                </div>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>



    @stop

