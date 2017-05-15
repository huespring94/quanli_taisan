@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản có trong kho
@stop

@section('home')
<li>Kho</li>
<li class="active">Danh sách</li>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Danh sách tài sản trong kho</h3>
        <a href="{{route('download-detail-store')}}" type="button" class="btn bg-navy margin pull-right">
            <i class="fa fa-download"></i>
            Xuất file excel</a>
    </div>
    <div class="box-body">
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã nhập kho</th>
                    <th>Ngày nhập</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
                    <th>Kho</th>
                    <th>Số lượng CL</th>
                    <th>Thành tiền</th>
                    <th>Tỷ lệ % CL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($details as $detail)
                <tr>
                    <td>{{$detail->id}}</td>
                    <td>{{$detail->importStore->date_import}}</td>
                    <td>{{$detail->stuff->name}}</td>
                    <td>{{$detail->stuff->supplier->name}}</td>
                    <td>{{$detail->importStore->store->name}}</td>
                    <td>{{$detail->quantity}}</td>
                    <td align="right">{{number_format($detail->quantity * $detail->price_unit)}}</td>
                    <td>
                        @if ($detail->status <= 20)
                        <span class="badge bg-warning">{{$detail->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$detail->status}}%</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('delete-detail', [$detail->id])}}" class="btn bg-red margin pull-right">
                            <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@stop



