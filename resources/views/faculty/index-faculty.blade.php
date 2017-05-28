@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản khoa
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Danh sách</li>
@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Khoa <b>{{Auth::user()->faculty->name}}</b></h3>
        <form method="POST" action="{{route('download-list')}}">
            {{ csrf_field() }}
            <button type="submit" class="btn bg-navy pull-right">
                <i class="fa fa-download"></i>
                Xuất file excel</button>
        </form>
    </div>

    <div class="box-body">
        <caption></caption>
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã TB</th>
                    <th>Ngày SD</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Tỷ lệ % CL</th>
                    <th>Thanh lí</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($importFacs as $importFac)
                <tr>
                    <td>
                        @if($importFac->quantity < $importFac->quantity_start)
                        <a href="{{route('detail-store-faculty', [$importFac->store_faculty_id])}}" class="btn bg-gray-light pull-right">
                            {{$importFac->store_faculty_id}}</a>
                        @else
                        {{$importFac->store_faculty_id}}
                        @endif
                    </td>
                    <td>{{$importFac->date_import}}</td>
                    <td>{{$importFac->stuff->name}}</td>
                    <td>{{$importFac->stuff->supplier->name}}</td>
                    <td>{{$importFac->quantity_start}}</td>
                    <td align="right">{{number_format($importFac->quantity * $importFac->detailImportStore->price_unit)}}</td>
                    <td>
                        @if ($importFac->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$importFac->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$importFac->detailImportStore->status}}%</span>
                        @endif
                    </td>
                    <td>
                        @if (isset($importFac->liquidation_quantity))
                        <i>Đã thanh lí ({{$importFac->liquidation_quantity}})</i>
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

