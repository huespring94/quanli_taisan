@extends('layouts.template_admin')

@section('title_content')
Nhập tài sản cho phòng
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Nhâp kho phòng</li>
@stop

@section('content')
<div class="box">
    <form class="form-horizontal" role="form" method="POST" action="">
        {{ csrf_field() }}
        <div class="box-header">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn phòng</label>
                <div class="col-sm-6">
                    <select name="room_id" class="form-control">
                        <option value="">Chọn phòng</option>
                        @foreach($rooms as $room)
                        <option {{!isset($roomId) ? '' : ($roomId == $room->room_id ? "selected" : '')}} value="{{$room->room_id}}">{{$room->name}}</option>
                        @endforeach
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
        <h3 class="box-title">Danh sách tài sản</h3>
    </div>
    <div class="box-body">
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã TB</th>
                    <th>Ngày SD</th>
                    <th>Tên tài sản</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Tỷ lệ % CL</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($rooms as $room)
                <tr>
                    <td>PHÒNG {{$room->name}}</td>
                </tr>
                @foreach ($room->storeRooms as $detail)
                <tr>
                    <td>{{$detail->store_room_id}}</td>
                    <td>{{$detail->date_import}}</td>
                    <td>{{$detail->stuff->name}}</td>
                    <td>{{$detail->quantity}}</td>
                    <td align="right">{{number_format($detail->quantity * $detail->storeFaculty->detailImportStore->price_unit)}}</td>
                    <td>
                        @if ($storeRoom->storeFaculty->detailImportStore->status <= 20)
                        <span class="badge bg-red">{{$detail->storeFaculty->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$detail->storeFaculty->detailImportStore->status}}%</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>


@stop

