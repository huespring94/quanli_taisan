@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản phòng
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Danh sách</li>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Thông tin tài sản khoa được chuyển cho các phòng</h3>
        <a type="button" href="{!! url('fac/store-faculty-list') !!}" class="btn bg-olive margin pull-right">
                <i class="fa fa-arrow-circle-left"></i>
                Quay lại</a>
    </div>

    <div class="box-body">
        <caption></caption>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã TB</th>
                    <th>Ngày SD</th>
                    <th>Tên tài sản</th>
                    <th>Tổng số lượng</th>
                    <th>Số lượng CL</th>
                    <th>Thành tiền</th>
                    <th>Tỷ lệ % CL</th>
                </tr>
            </thead>
            <tbody align="center">
                <tr>
                    <td>{{$importFac->store_faculty_id}}</td>
                    <td>{{$importFac->date_import}}</td>
                    <td>{{$importFac->stuff->name}}</td>
                    <td>{{$importFac->quantity_start}}</td>
                    <td>{{$importFac->quantity}}</td>
                    <td align="right">{{number_format($importFac->quantity * $importFac->detailImportStore->price_unit)}}</td>
                    <td>
                        @if ($importFac->detailImportStore->status <= 20)
                        <span class="badge bg-red">{{$importFac->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$importFac->detailImportStore->status}}%</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Danh sách tài sản được chuyển cho các phòng</h3>
    </div>
    <div class="box-body">
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ngày SD</th>
                    <th>Mã TB</th>
                    <th>Phòng</th>
                    <th>Tên tài sản</th>
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



