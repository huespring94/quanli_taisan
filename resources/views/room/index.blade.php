@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản phòng
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Nhâp kho phòng</li>
@stop

@section('content')
<div class="box">
    <form class="form-horizontal" role="form" method="POST" action="{{url('fac/store-room-fac')}}">
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
    <button type="button" class="btn bg-navy margin pull-right">
                <i class="fa fa-download"></i>
                Xuất file excel</button>
    <div class="box-body">
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ngày SD</th>
                    <th>Mã TB</th>
                    <th>Phòng</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Tỷ lệ % CL</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($storeRooms as $detail)
                <tr>
                    <td>{{$detail->date_import}}</td>
                    <td>{{$detail->store_room_id}}</td>
                    <td>{{$detail->room->name}}</td>
                    <td>{{$detail->stuff->name}}</td>
                    <td>{{$detail->stuff->supplier->name}}</td>
                    <td>{{$detail->quantity}}</td>
                    <td align="right">{{number_format($detail->quantity * $detail->storeFaculty->detailImportStore->price_unit)}}</td>
                    <td>
                        @if ($detail->storeFaculty->detailImportStore->status <= 20)
                        <span class="badge bg-red">{{$detail->storeFaculty->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$detail->storeFaculty->detailImportStore->status}}%</span>
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

