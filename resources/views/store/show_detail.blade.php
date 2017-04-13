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
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li><a href="#tab_1" data-toggle="tab">Nhập file</a></li>
        <li class="active"><a href="#tab_2" data-toggle="tab">Nhập thủ công</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="tab_1">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Blank Box</h3>
                    <div class="form-group pull-right">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">

                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                </div>
                <div class="box-body">
                    The great content goes here
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane active" id="tab_2">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Thông tin nhập kho</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã nhập kho</th>
                                <th>Kho nhập</th>
                                <th>Ngày nhập</th>
                                <th>Người nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$importStore->id}}</td>
                                <td>{{$importStore->store->name}}</td>
                                <td>{{$importStore->date_import}}</td>
                                <td>{{$importStore->user->firstname}} {{$importStore->user->lastname}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Chi tiết nhập kho</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã nhập thiết bị</th>
                                <th>Mã tài sản</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Tên tài sản</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailImports as $detail)
                            <tr>
                                <td>{{$detail->id}}</td>
                                <td>{{$detail->stuff_id}}</td>
                                <td>{{$detail->quantity}}</td>
                                <td>{{$detail->price_unit}}</td>
                                <td>{{$detail->quantity * $detail->price_unit}} </td>
                                <td>{{$detail->stuff->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Tổng tiền</th>
                                <th colspan="2">{{$amount}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>

@stop