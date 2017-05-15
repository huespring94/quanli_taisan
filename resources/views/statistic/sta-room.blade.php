@extends('layouts.template_admin')

@section('title_content')
Thống kê theo phòng
@stop

@section('home')
<li>Thống kê</li>
<li class="active">TK phòng</li>
@stop

@section('content')

<div class="box">
    <form class="form-horizontal" role="form" method="POST" action="{{route('statis-by-room-year')}}">
        {{ csrf_field() }}
        <div class="box-header">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn năm</label>
                <div class="col-sm-3">
                    <select name="year" class="form-control">
                        @for($i = $years['min']; $i <= $years['max']; $i++)
                        <option {{!isset($years['now']) ? '' : ($years['now'] == $i ? "selected" : '')}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <label class="col-sm-2 control-label">Chọn phòng</label>
                <div class="col-sm-3">
                    <select name="room_id" class="form-control">
                        @foreach($rooms as $room)
                        <option {{!isset($roomId) ? '' : ($room->room_id == $roomId ? "selected" : '')}} value="{{$room->room_id}}">{{$room->name}}</option>
                        @endforeach
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
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã TB</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
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
                    <td>{{$importRoom->quantity_start}}</td>
                    <td>{{$importRoom->quantity}}</td>
                    <td>
                        @if(isset($importRoom->liquidation))
                        {{$importRoom->liquidation}}
                        @endif
                    </td>
                    <td>{{$importRoom->storeFaculty->detailImportStore->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>


@stop

