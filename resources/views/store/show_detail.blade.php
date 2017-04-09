@extends('layouts.template_admin')

@section('title_content')
Nhập chi tiết kho hàng
@stop

@section('home')
<li class="active">Nhập kho</li>
@stop

@section('content')

@if(Session::has('msg'))
<div class="callout callout-success">
    <h4>Success!</h4>

    <p>{{ Session::get('msg') }}</p>
</div>
@endif

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Hover Data Table</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Mã nhập thiết bị</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Mã tài sản</th>
                    <th>Tên tài sản</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailImports as $detail)
                <tr>
                    <td>{{$detail->id}}</td>
                    <td>{{$detail->quantity}}</td>
                    <td>{{$detail->price_unit}}</td>
                    <td>{{$detail->quantity * $detail->price_unit}} </td>
                    <td>{{$detail->stuff_id}}</td>
                    <td>{{$detail->stuff->name}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Tổng tiền</th>
                    <th colspan="3"></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.box-body -->
</div>

@stop