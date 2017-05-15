@extends('layouts.template_admin')

@section('title_content')
Thiết bị hết hạn sử dụng
@stop

@section('home')
<li>DSTS</li>
<li class="active">Hết hạn</li>
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

        <div class="box box-danger">
            <div class="box-header">
            </div>
            <div class="box-body">
                <table id="mydata" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã TB</th>
                            <th>Ngày SD</th>
                            <th>Tên tài sản</th>
                            <th>Số lượng CL</th>
                            <th>Tỷ lệ % CL</th>
                            <th>Thanh lí</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach($atrophyStores as $atrophyStore)
                        <tr>
                            <td>{{$atrophyStore->id}}</td>
                            <td>{{$atrophyStore->importStore->date_import}}</td>
                            <td>{{$atrophyStore->stuff->name}}</td>
                            <td>{{$atrophyStore->quantity}}</td>
                            <td>
                                @if ($atrophyStore->status <= 20)
                                <span class="badge bg-warning">{{$atrophyStore->status}}%</span>
                                @else
                                <span class="badge bg-light-blue">{{$atrophyStore->status}}%</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('delete-atrophy-store', [$atrophyStore->id])}}" class="btn bg-green pull-right">
                                    OK</a>
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

