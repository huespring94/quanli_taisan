@extends('layouts.template_admin')

@section('title_content')
Nhập tài sản cho khoa
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Nhap kho khoa</li>
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
            <h3 class="box-title">Thông tin nhập</h3>
        </div>
        <a type="button" href="{{route('import-faculty.create')}}" class="btn bg-orange margin pull-right">
            <i class="fa fa-plus-circle"></i>
            Thêm mới</a>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Ngày nhập</th>
                        <th>Mã tài sản</th>
                        <th>Mã khoa</th>
                        <th>Khoa</th>
                        <th>Loại tài sản</th>
                        <th>Tài sản</th>
                        <th>Số lượng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$importFaculties['import_faculty'][0]->date_import}}</td>
                        <td>{{$stuff->stuff_id}}</td>
                        <td>{{$faculty->faculty_id}}</td>
                        <td>{{$faculty->name}}</td>
                        <td>{{$stuff->kindStuff->name}}</td>
                        <td>{{$stuff->name}}</td>
                        <td>{{$quantity}}</td>
                        <td>
                            <a id="detail-import-delete" class="btn bg-red pull-right" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-trash"></i></a>
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
                                <form method="POST" action="{{url('admin/delete-import-faculty')}}">
                                    {{ csrf_field() }}
                                    <input name='stuff_id' value="{{$stuff->stuff_id}}" hidden>
                                    <input name='faculty_id' value="{{$faculty->faculty_id}}" hidden>
                                    <input name='date_import' value="{{$importFaculties['import_faculty'][0]->date_import}}" hidden>
                                    <button type="submit" class="btn btn-default">OK</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Chi tiết nhập kho</h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã thiết bị</th>
                        <th>Ngày SD</th>
                        <th>SL có</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Tỷ lệ còn lại</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($importFaculties['import_faculty'] as $key => $detail)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$detail->store_faculty_id}}</td>
                        <td>{{$detail->date_import}}</td>
                        <td>{{$detail->quantity}}</td>
                        <td>{{number_format($importFaculties['detail'][$key]->price_unit)}}</td>
                        <td>{{number_format($detail->quantity * $importFaculties['detail'][$key]->price_unit)}} </td>
                        <td>
                            @if ($detail->status <= 20)
                            <span class="badge bg-red">{{$detail->status}}%</span>
                            @else
                            <span class="badge bg-light-blue">{{$detail->status}}%</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Tổng tiền</th>
                        <th colspan="2">{{number_format($importFaculties['amount'])}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@stop