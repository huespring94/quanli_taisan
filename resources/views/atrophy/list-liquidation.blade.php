@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản thanh lí
@stop

@section('home')
<li class="active">Danh sách</li>
@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Khoa <b>{{Auth::user()->faculty->name}}</b></h3>
        <button type="button" class="btn bg-navy margin pull-right">
            <i class="fa fa-download"></i>
            Xuất file excel</button>
    </div>

    <div class="box-body">
        <caption></caption>
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã TB</th>
                    <th>Ngày TL</th>
                    <th>Số lượng</th>
                    <th>Tên tài sản</th>
                    <th>Tỷ lệ % CL</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($liquidations as $liquidation)
                <tr>
                    @if($liquidation->store_type == config('constant.type_school'))
                    <td>{{$liquidation->detail_import_store_id}}</td>
                    @else
                    <td>{{$liquidation->store_liquidation_id}}</td>
                    @endif
                    
                    <td>{{$liquidation->date_liquidation}}</td>
                    <td>{{$liquidation->quantity}}</td>
                    
                    @if ($liquidation->store_type == config('constant.type_faculty'))
                        <td>{{$liquidation->storeFaculty->stuff->name}}</td>
                        <td>
                        @if ($liquidation->storeFaculty->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$liquidation->storeFaculty->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$liquidation->storeFaculty->detailImportStore->status}}%</span>
                        @endif
                        </td>
                    @elseif ($liquidation->store_type == config('constant.type_room'))
                        <td>{{$liquidation->storeRoom->stuff->name}}</td>
                        <td>
                        @if ($liquidation->storeRoom->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$liquidation->storeRoom->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$liquidation->storeRoom->detailImportStore->status}}%</span>
                        @endif
                        </td>
                    @else
                        <td>{{$liquidation->detailImportStore->stuff->name}}</td>
                        <td>
                            @if ($liquidation->detailImportStore->status <= 20)
                            <span class="badge bg-warning">{{$liquidation->detailImportStore->status}}%</span>
                            @else
                            <span class="badge bg-light-blue">{{$liquidation->detailImportStore->status}}%</span>
                            @endif
                        </td>
                    @endif
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

