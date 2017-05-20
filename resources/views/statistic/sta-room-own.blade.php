@extends('layouts.template_admin')

@section('title_content')
Thống kê phòng
@stop

@section('home')
<li>Thống kê</li>
<li class="active">TK phòng</li>
@stop

@section('content')

<div class="box">
    <h4 class="box-title">Phòng <b>{{$room->name}}</b></h4>
    <form class="form-horizontal" role="form" method="POST" action="{{route('statis-by-room-year')}}">
        {{ csrf_field() }}
        <div class="box-header">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn năm</label>
                <div class="col-sm-8">
                    <select name="year" class="form-control">
                        @for($i = $years['min']; $i <= $years['max']; $i++)
                        <option {{!isset($years['now']) ? '' : ($years['now'] == $i ? "selected" : '')}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-info pull-right import_faculty-btn">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="box">
    <div class="box-header">
        <form method="POST" action="{{route('download-statistic')}}">
            {{ csrf_field() }}
            <input name="year" value="{{!isset($years['now']) ? '' : $years['now']}}" hidden>
            <input name="room_id" value="{{$room->room_id}}" hidden>
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
                    <th>SL sử dụng</th>
                    <th>SL thanh lí</th>
                    <th>Tỷ lệ % CL</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($importRooms as $key => $importRoom)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$importRoom->store_room_id}}</td>
                    <td>{{$importRoom->stuff->name}}</td>
                    <td>{{$importRoom->stuff->supplier->name}}</td>
                    <td>{{explode('-', $importRoom->date_import)[0]}}</td>
                    <td>{{$importRoom->quantity_start}}</td>
                    <td>{{$importRoom->quantity}}</td>
                    <td>
                        @if(isset($importRoom->liquidation))
                        {{$importRoom->liquidation}}
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        @if ($importRoom->storeFaculty->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$importRoom->storeFaculty->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$importRoom->storeFaculty->detailImportStore->status}}%</span>
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

