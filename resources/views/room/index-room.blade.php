@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản phòng
@stop

@section('home')
<li>Kho phòng</li>
<li class="active">Danh sách</li>
@stop

@section('content')

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
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($storeRooms as $detail)
                <tr>
                    <td>{{$detail->date_import}}</td>
                    <td>{{$detail->store_room_id}}</td>
                    <td>{{$detail->stuff->name}}</td>
                    <td>{{$detail->stuff->supplier->name}}</td>
                    <td>{{$detail->quantity}}</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>


@stop

