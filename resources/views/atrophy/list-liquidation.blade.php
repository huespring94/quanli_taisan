@extends('layouts.template_admin')

@section('title_content')
Danh sách tài sản đã thanh lí
@stop

@section('home')
<li class="active">Danh sách</li>
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(Auth::user()->role->name == config('constant.r_admin') || Auth::user()->role->name == config('constant.r_accountant'))
        <a href="{{route('download-liquidation')}}" type="button" class="btn bg-navy margin pull-right">
            <i class="fa fa-download"></i>
            Xuất file excel</a>
        @elseif(Auth::user()->role->name == config('constant.r_faculty'))
        <a href="{{route('download-liquidation-faculty')}}" type="button" class="btn bg-navy margin pull-right">
            <i class="fa fa-download"></i>
            Xuất file excel</a>
        @else
        <a href="{{route('download-liquidation-room')}}" type="button" class="btn bg-navy margin pull-right">
            <i class="fa fa-download"></i>
            Xuất file excel</a>
        @endif
    </div>

    <div class="box-body">
        <caption></caption>
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã TB</th>
                    <th>Ngày TL</th>
                    <th>Số lượng</th>
                    <th>Địa điểm</th>
                    <th>Ngày SD</th>
                    <th>Tên tài sản</th>
                    <th>Tỷ lệ % CL</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($liquidations as $liquidation)
                <tr>
                    <td>{{$liquidation->store_liquidation_id}}</td>
                    
                    <td>{{$liquidation->date_liquidation}}</td>
                    <td>{{$liquidation->quantity}}</td>
                    
                    @if ($liquidation->store_type == config('constant.type_faculty'))
                        <td>{{$liquidation->store_type}} - {{$liquidation->storeFaculty->faculty->name}}</td>
                        <td>{{$liquidation->storeFaculty->date_import}}</td>
                        <td>{{$liquidation->storeFaculty->stuff->name}}</td>
                        <td>
                        @if ($liquidation->storeFaculty->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$liquidation->storeFaculty->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$liquidation->storeFaculty->detailImportStore->status}}%</span>
                        @endif
                        </td>
                    @elseif ($liquidation->store_type == config('constant.type_room'))
                        <td>{{$liquidation->store_type}} - {{$liquidation->storeRoom->room->name}}</td>
                        <td>{{$liquidation->storeRoom->date_import}}</td>
                        <td>{{$liquidation->storeRoom->stuff->name}}</td>
                        <td>
                        @if ($liquidation->storeRoom->storeFaculty->detailImportStore->status <= 20)
                        <span class="badge bg-warning">{{$liquidation->storeRoom->storeFaculty->detailImportStore->status}}%</span>
                        @else
                        <span class="badge bg-light-blue">{{$liquidation->storeRoom->storeFaculty->detailImportStore->status}}%</span>
                        @endif
                        </td>
                    @else
                        <td>{{$liquidation->store_type}} - {{$liquidation->detailImportStore->importStore->store->name}}</td>
                        <td>{{$liquidation->detailImportStore->importStore->date_import}}</td>
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

