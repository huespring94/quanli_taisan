@extends('layouts.template_admin')

@section('title_content')
Thống kê tài sản theo khoa
@stop

@section('home')
<li>Thống kê</li>
<li class="active">TK khoa</li>
@stop

@section('content')

<div class="box">
    <form class="form-horizontal" role="form" method="POST" action="{{route('statis-faculty-by-year')}}">
        {{ csrf_field() }}
        <div class="box-header">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn năm</label>
                <div class="col-sm-6">
                    <select name="year" class="form-control">
                        @for($i = $years['min']; $i <= $years['max']; $i++)
                        <option {{!isset($years['now']) ? '' : ($years['now'] == $i ? "selected" : '')}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div><div class="col-sm-2">
                    <button type="submit" class="btn btn-info pull-right import_faculty-btn">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Khoa <b>{{Auth::user()->faculty->name}}</b></h3>
        <form method="POST" action="{{route('download-statistic')}}">
            {{ csrf_field() }}
            <input name="year" value="{{!isset($years['now']) ? '' : $years['now']}}" hidden>
            <button type="submit" class="btn bg-navy pull-right">
            <i class="fa fa-download"></i>
            Xuất file excel</button>
        </form>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã TB</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
                    <th>Năm SD</th>
                    <th>SL nhập</th>
                    <th>SL tồn kho</th>
                    <th>SL thanh lí</th>
                    <th>Tỷ lệ % CL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($importFacs as $key => $importFac)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$importFac->store_faculty_id}}</td>
                    <td>{{$importFac->stuff->name}}</td>
                    <td>{{$importFac->stuff->supplier->name}}</td>
                    <td>{{explode('-', $importFac->date_import)[0]}}</td>

                    <td>{{$importFac->quantity_start}}</td>
                    <td>{{$importFac->quantity}}</td>
                    <td>
                        @if(isset($importFac->liquidation))
                        {{$importFac->liquidation}}
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        @if ($importFac->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$importFac->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$importFac->detailImportStore->status}}%</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>


@stop

