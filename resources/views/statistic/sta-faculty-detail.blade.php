@extends('layouts.template_admin')

@section('title_content')
Thống kê theo khoa
@stop

@section('home')
<li>Thống kê</li>
<li class="active">TK khoa</li>
@stop

@section('content')

<div class="box">
    <div class="box-header">
            <h3 class="box-title">Thống kê tài sản</h3>
        </div>
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã TS</th>
                    <th>Ngày SD</th>
                    <th>SL nhập</th>
                    <th>Tỷ lệ % CL</th>
                    <th>Ngày TL</th>
                    <th>SL thanh lí</th>
                    <th></th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($importFacs as $key => $importFac)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$importFac->stuff->name}}</td>
                    <td>{{$importFac->stuff->supplier->name}}</td>
                    <td>{{$importFac->quantity_start}}</td>
                    <td>{{$importFac->quantity}}</td>
                    <td>{{$importFac->liquidation}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

@stop

