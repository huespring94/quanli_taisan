@extends('layouts.template_admin')

@section('title_content')
Nhập tài sản cho khoa
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Nhap kho khoa</li>
@stop

@section('content')
@if(Session::has('msg'))
<div class="callout callout-warning">
    <h4>Message</h4>

    <p>{{ Session::get('msg') }}</p>
</div>
@endif
<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Nhập kho khoa</h3>
        </div>
    </div>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('import-faculty.store') }}">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn khoa</label>
                <div class="col-sm-8">
                    <select name="faculty_id" class="form-control">
                        <option value="">Chọn khoa</option>
                        @foreach($faculties as $faculty)
                        <option value="{{$faculty->faculty_id}}">{{$faculty->name}}</option>
                        @endforeach
                    </select>
                    <div class="has-error">
                        @foreach ($errors->get('faculty_id') as $error)
                        <span class="help-block">
                            {{ $error }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn tài sản</label>
                <div class="col-sm-8">
                    <select name="stuff_id" class="form-control" id="fac_import">
                        <option value="">Chọn tài sản</option>
                        @foreach($stuffs as $stuff)
                        <option value="{{$stuff->stuff_id}}">{{$stuff->name}}</option>
                        @endforeach
                    </select>
                    <div class="has-error">
                        @foreach ($errors->get('stuff_id') as $error)
                        <span class="help-block">
                            {{ $error }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Số lượng</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-database"></i>
                        </span>
                        <input  value="1" min="1" name="quantity" class="form-control pull-right quantity-select">
                    </div>
                    <div class="has-error">
                        @foreach ($errors->get('quantity') as $error)
                        <span class="help-block">
                            {{ $error }}
                        </span>
                        @endforeach
                    </div>
                </div>
                <label class="col-sm-2 control-label">Số lượng còn lại</label>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-database"></i>
                        </div>
                        <input type="text" disabled="true" value="0" class="form-control pull-right quantity-stuff">
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-info pull-right import_faculty-btn">Chuyển đến khoa</button>
            </div>
        </div>
    </form>

</div>
<!-- /.tab-pane -->
</div>
</div>

@stop
