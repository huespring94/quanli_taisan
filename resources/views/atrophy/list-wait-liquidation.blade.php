@extends('layouts.template_admin')

@section('title_content')
Thiết bị yêu cầu thanh lí
@stop

@section('home')
<li>Kho</li>
<li class="active">Thanh lí</li>
@stop

@section('content')
@if (Session::has('msg'))
<div class="callout callout-success">
    <h4>Thành công</h4>

    <p>{{ Session::get('msg') }}</p>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="box-header">
            <a href="{{route('request-accept-all')}}" type="button" class="btn bg-green margin pull-right">
                <i class="fa fa-check-square"></i>
                Thanh lí tất cả</a>
            <a href="{{route('liquidation')}}" type="button" class="btn bg-blue margin pull-right">
                <i class="fa fa-list"></i>
                Danh sách thanh lí</a>
        </div>
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Thiết bị yêu cầu thanh lí</h3>
            </div>
            <div class="box-body">
                <table id="mydata" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã TB</th>
                            <th>Tên tài sản</th>
                            <th>Ngày SD</th>
                            <th>Tỷ lệ CL</th>
                            <th>Địa điểm</th>
                            <th>Loại yêu cầu</th>
                            <th>Ngày yêu cầu</th>
                            <th>Số lượng</th>
                            <th>Chấp nhận</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach ($requests as $request)
                        <tr>
                            <td>{{$request->store_type_id}}</td>
                            @if ($request->type == config('constant.type_faculty'))
                            <td>{{$request->storeFaculty->stuff->name}}</td>
                            <td>{{$request->storeFaculty->date_import}}</td>
                            <td>
                                @if ($request->storeFaculty->detailImportStore->status <= 20)
                                <span class="badge bg-warning">{{$request->storeFaculty->detailImportStore->status}}%</span>
                                @else
                                <span class="badge bg-light-blue">{{$request->storeFaculty->detailImportStore->status}}%</span>
                                @endif
                            </td>
                            <td>{{$request->type}} - {{$request->storeFaculty->faculty->name}}</td>
                            @else
                            <td>{{$request->storeRoom->stuff->name}}</td>
                            <td>{{$request->storeRoom->date_import}}</td>
                            <td>
                                @if ($request->storeRoom->storeFaculty->detailImportStore->status <= 20)
                                <span class="badge bg-warning">{{$request->storeRoom->storeFaculty->detailImportStore->status}}%</span>
                                @else
                                <span class="badge bg-light-blue">{{$request->storeRoom->storeFaculty->detailImportStore->status}}%</span>
                                @endif
                            </td>
                            <td>{{$request->type}} - {{$request->storeRoom->room->name}}</td>
                            @endif
                            <td>{{$request->kind_request}}</td>
                            <td>{{$request->created_at->format('d/m/Y')}}</td>
                            <td>{{$request->quantity}}</td>
                            <td>
                                <a href="{{route('request-accept', [$request->id])}}" class="btn bg-green pull-right">
                                    <i class="fa fa-check-square"></i></a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

