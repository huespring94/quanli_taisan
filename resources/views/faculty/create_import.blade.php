@extends('layouts.template_admin')

@section('title_content')
Nhap TS cho kho khoa
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Nhap kho khoa</li>
@stop

@section('content')
<!-- Custom Tabs -->
<div class="nav-tabs-custom">
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
    <!-- /.tab-pane -->
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
                        @if ($errors->has('faculty_id'))
                        <span class="help-block">
                            {{ $errors->first('faculty_id') }}
                        </span>
                        @endif
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
                        @if ($errors->has('stuff_id'))
                        <span class="help-block">
                            {{ $errors->first('stuff_id') }}
                        </span>
                        @endif
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
                        <input type="number" value="1" min="1" name="quantity" class="form-control pull-right quantity-select">
                    </div>
                    <div class="has-error">
                        @if ($errors->has('quantity'))
                        <span class="help-block">
                            {{ $errors->first('quantity') }}
                        </span>
                        @endif
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
