@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản phòng
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Nhâp kho phòng</li>
@stop

@section('content')
@if(Session::has('msg'))
<div class="callout callout-success">
    <h4>Thành công</h4>

    <p>{{ Session::get('msg') }}</p>
</div>
@elseif(Session::has('msge'))
<div class="callout callout-warning">
    <h4>Thất bại</h4>

    <p>{{ Session::get('msge') }}</p>
</div>
@endif
<div class="box">
    <form class="form-horizontal" role="form" method="POST" action="{{route('store-room-fac')}}">
        {{ csrf_field() }}
        <div class="box-header">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn phòng</label>
                <div class="col-sm-6">
                    <select name="room_id" class="form-control">
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
        <button type="button" class="btn bg-navy margin pull-right">
            <i class="fa fa-download"></i>
            Xuất file excel</button>
    </div>
    <div class="box-body">
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ngày SD</th>
                    <th>Mã TB</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Tỷ lệ % CL</th>
                    <th>Thanh lí</th>
                    <th></th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($storeRooms as $detail)
                <tr>
            <form method="POST" action="{{route('update-room')}}">
                {{ csrf_field() }}
                <td>{{$detail->date_import}}</td>
                <td>{{$detail->store_room_id}}</td>
                <td>{{$detail->stuff->name}}</td>
                <td>{{$detail->stuff->supplier->name}}</td>
                <td>
                    <input type="text" name="id" value="{{$detail->id}}" hidden>
                    @if (!isset($detail->liquidation_quantity))
                    <input type="number" min="1" name="quantity" value ="{{empty($quantity) ? $detail->quantity : $quantity}}" class="form-control">
                    @else
                    <input type="number" name="quantity" disabled value ="{{$detail->quantity}}" class="form-control">
                    @endif
                </td>
                <td align="right">{{number_format($detail->quantity * $detail->storeFaculty->detailImportStore->price_unit)}}</td>
                <td>
                    @if ($detail->storeFaculty->detailImportStore->status <= 20)
                    <span class="badge bg-warning">{{$detail->storeFaculty->detailImportStore->status}}%</span>
                    @else
                    <span class="badge bg-light-blue">{{$detail->storeFaculty->detailImportStore->status}}%</span>
                    @endif
                </td>
                <td>
                    @if (isset($detail->liquidation_quantity))
                    @if($detail->liquidation_status)
                    <i>Đã thanh lí ({{$detail->liquidation_quantity}})</i>
                    @else
                    <i>Đang chờ ({{$detail->liquidation_quantity}})</i>
                    @endif
                    @else
                    -
                    @endif
                </td>
                <td>
                    @if (!isset($detail->liquidation_quantity))
                    <button type="submit" class="btn bg-olive pull-right">
                        <i class="fa fa-upload"></i></button>
                    <a href="{{route('delete-room', [$detail->id])}}" class="btn bg-red pull-right">
                        <i class="fa fa-trash"></i></a>
                    @endif
                </td>
            </form>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>


@stop

