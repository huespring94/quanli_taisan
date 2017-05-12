@extends('layouts.template_admin')

@section('title_content')
Thiết bị trong kho 
@stop

@section('home')
<li>Kho</li>
<li class="active">Thanh lí</li>
@stop

@section('content')
<div class="row">
    <div class="col-md-7">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Thiết bị hết hạn</h3>
            </div>
            <div class="box-body">
                <table id="mydata" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã TB</th>
                            <th>Ngày SD</th>
                            <th>Tên tài sản</th>
                            <th>Số lượng</th>
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
                                <a id="detail-import-delete" class="btn bg-green pull-right" data-toggle="modal" data-target="#myModal">
                                    OK</a>
                            </td>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Thanh lí</h4>
                                </div>
                                <div class="modal-body">
                                    <h5>Bạn chắc chắn muốn thanh lí thiết bị này?</h5>
                                </div>
                                <div class="modal-footer">
                                    <form method="GET" action="{{url('admin/delete-atrophy-store', [$atrophyStore->id])}}">
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
                </table>

            </div>
            <!-- /.box-body -->
        </div>

    </div>
    <!-- /.col (left) -->
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Thiết bị đã thanh lí</h3>
                <a type="button" href="" class="btn bg-gray-light margin pull-right">
                    <i class="fa fa-angle-double-right"></i>
                    Chi tiết</a>
            </div>
            <div class="box-body">
                <table id="mydata-add" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ngày SD</th>
                            <th>Tên tài sản</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach($liquidations as $liquidation)
                        <tr>
                            <td>{{$liquidation->detailImportStore->importStore->date_import}}</td>
                            <td>{{$liquidation->detailImportStore->stuff->name}}</td>
                            <td>{{$liquidation->quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <!-- /.col (right) -->
</div>

@stop

