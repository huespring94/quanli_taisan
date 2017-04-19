@extends('layouts.template_admin')

@section('title_content')
Nhập kho hàng
@stop

@section('home')
<li class="active">Nhap kho</li>
@stop

@section('content')

@if(Session::has('msg'))
<div class="callout callout-info">
    <h4>Information</h4>

    <p>{{ Session::get('msg') }}</p>
</div>
@endif

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Nhập kho hàng</h3>
        </div>
        <!-- /.box-header -->
        <form class="form-horizontal" role="form" method="POST" action="{{ route('import-store.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Chon kho hang</label>
                    <div class="col-sm-8">
                        <select name="store_id" class="form-control">
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Ngay nhap</label>
                    <div class="col-sm-8">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="date_import" class="form-control pull-right">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-info pull-right">Tao</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- nav-tabs-custom -->
@stop
