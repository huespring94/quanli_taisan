@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản của khoa
@stop

@section('home')
<li>Kho khoa</li>
<li class="active">Danh sách</li>
@stop

@section('content')

<div class="box">
    <form class="form-horizontal" role="form" method="POST" action="{{route('store-faculty')}}">
        {{ csrf_field() }}
        <div class="box-header">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn khoa</label>
                <div class="col-sm-6">
                    <select name="faculty_id" class="form-control">
                        @foreach($faculties as $faculty)
                        <option {{!isset($facultyId) ? '' : ($facultyId == $faculty->faculty_id ? "selected" : '')}} value="{{$faculty->faculty_id}}">{{$faculty->name}}</option>
                        @endforeach
                    </select>
                </div><div class="col-sm-2">
                    <button type="submit" class="btn btn-info pull-right import_faculty-btn">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>
</div>

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
                    <th>Mã TB</th>
                    <th>Ngày SD</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Tỷ lệ % CL</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($importFacs as $importFac)
                <tr>
                    <td>{{$importFac->store_faculty_id}}</td>
                    <td>{{$importFac->date_import}}</td>
                    <td>{{$importFac->stuff->name}}</td>
                    <td>{{$importFac->stuff->supplier->name}}</td>
                    <td>{{$importFac->quantity_start}}</td>
                    <td align="right">{{number_format($importFac->quantity_start * $importFac->detailImportStore->price_unit)}}</td>
                    <td>
                        @if ($importFac->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$importFac->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$importFac->detailImportStore->status}}%</span>
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

