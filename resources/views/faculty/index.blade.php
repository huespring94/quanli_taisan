@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản của các khoa
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Danh sách</li>
@stop

@section('content')

<div class="box">
        <div class="box-header">
            
            
        </div>
        
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã thiết bị</th>
                        <th>Ngày SD</th>
                        <th>Khoa</th>
                        <th>Tên tài sản</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Tỷ lệ % còn lại</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody align="center">
                    @foreach ($importFacs as $importFac)
                    <tr>
                        <td>{{$importFac->store_faculty_id}}</td>
                        <td>{{$importFac->date_import}}</td>
                        <td>{{$importFac->faculty->name}}</td>
                        <td>{{$importFac->stuff->name}}</td>
                        <td>{{$importFac->quantity}}</td>
                        <td align="right">{{number_format($importFac->quantity * $importFac->detailImportStore->price_unit)}}</td>
                        <td>{{$importFac->status}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Tổng tiền</th>
                    </tr>
                </tfoot>
            </table>
            <div class="pull-right">{{$importFacs->render()}}</div>
        </div>
        <!-- /.box-body -->
    </div>



@stop

