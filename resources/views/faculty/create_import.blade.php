@extends('layouts.template_admin')

@section('title_content')
Nhap TS cho kho khoa
@stop

@section('home')
<li class="active">Nhap kho khoa</li>
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
                    <h3 class="box-title">Nhập kho khoa</h3>
                </div>
            </div>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/import-faculty/store') }}">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Chọn khoa</label>
                        <div class="col-sm-8">
                            <select name="stuff_id" class="form-control">
                                @foreach($faculties as $faculty)
                                <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Chọn tài sản</label>
                        <div class="col-sm-8">
                            <select name="stuff_id" class="form-control" id="fac_import">
                                @foreach($stuffs as $stuff)
                                <option value="{{$stuff->stuff_id}}">{{$stuff->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="detailImport">
                        hello
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Nhập chi tiết đơn hàng</button>
                </div>
            </form>

        </div>
        <!-- /.tab-pane -->
    </div>
</div>

@stop
