@extends('layouts.template_admin')

@section('title_content')
Nhập kho hàng
@stop

@section('home')
<li class="active">Nhap kho</li>
@stop

@section('content')

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Nhập file</a></li>
        <li><a href="#tab_2" data-toggle="tab">Nhập thủ công</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
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
        <div class="tab-pane" id="tab_2">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nhập kho hàng</h3>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" role="form" method="POST" action="{{ route('nhap.store') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Chon kho hang</label>
                            <div class="col-sm-10">
                                <select name="store_id" class="form-control">
                                    @foreach($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ngay nhap</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" name="date_import" class="form-control pull-right" id="datepicker">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Tao</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
@stop
