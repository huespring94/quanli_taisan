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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Thông tin nhập kho</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <button type="button" class="btn bg-navy margin pull-right">
                <i class="fa fa-download"></i>
                In đơn nhập hàng</button>
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
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Chi tiết nhập kho</h3>
        </div>
        
        <a type="button" href="{{route('import-store.show', [$importStore->id])}}" class="btn bg-olive margin pull-right">
                <i class="fa fa-cart-plus"></i>
                Thêm vào đơn nhập hàng</a>
        <a type="button" href="{{route('import-store.create')}}" class="btn bg-orange margin pull-right">
                <i class="fa fa-plus-circle"></i>
                Tạo đơn nhập hàng mới</a>
        
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
                        <th>Tỷ lệ còn lại</th>
                        <th></th>
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
                        <td><span class="badge bg-light-blue">{{$detail->status}}%</span></td>
                        <td>
                            <a id="detail-import-delete" class="btn bg-red pull-right" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-trash"></i></a>
                            <a href="{{route('import-store-detail.edit', [$detail->id])}}" class="btn bg-olive pull-right">
                                <i class="fa fa-edit"></i></a>
                        </td>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        Modal content
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Xóa</h4>
                            </div>
                            <div class="modal-body">
                                <h5>Bạn chắc chắn muốn xóa?</h5>
                            </div>
                            <div class="modal-footer">
                                <form method="GET" action="{{ url('admin/delete-detail-store', [$detail->id]) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">OK</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
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
@stop