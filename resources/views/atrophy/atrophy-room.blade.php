@extends('layouts.template_admin')

@section('title_content')
Thiết bị trong kho 
@stop

@section('home')
<li>Kho</li>
<li class="active">Thanh lí</li>
@stop

@section('content')
@if (Session::has('msg'))
<div class="callout callout-info">
    <h4>Message</h4>

    <p>{{ Session::get('msg') }}</p>
</div>
@endif

<div class="row">
    <div class="col-md-7">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Thiết bị hết hạn</h3>
                <a class="btn bg-green pull-right" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-send-o"></i>
                    Gửi yêu cầu</a>
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
                            <th>Tình trạng</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach($atrophyStores as $atrophyStore)
                        <tr>
                            <td>{{$atrophyStore->store_room_id}}</td>
                            <td>{{$atrophyStore->date_import}}</td>
                            <td>{{$atrophyStore->stuff->name}}</td>
                            <td>
                                @if(isset($atrophyStore->num_liquidation))
                                {{$atrophyStore->quantity - $atrophyStore->num_liquidation}}
                                @else
                                {{$atrophyStore->quantity}}
                                @endif
                            </td>
                            <td>
                                @if ($atrophyStore->storeFaculty->detailImportStore->status <= 20)
                                <span class="badge bg-warning">{{$atrophyStore->storeFaculty->detailImportStore->status}}%</span>
                                @else
                                <span class="badge bg-light-blue">{{$atrophyStore->storeFaculty->detailImportStore->status}}%</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($atrophyStore->num_liquidation))
                                <i>Đang chờ ({{$atrophyStore->num_liquidation}})</i>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <form class="form-horizontal" method="POST" action="{{route('request-liquidation-room')}}">
                {{ csrf_field() }}
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thanh lí</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Chọn mã thiết bị</label>
                                    <div class="col-sm-6">
                                        <select name="store_type_id" class="form-control">
                                            @foreach($atrophyStores as $atrophyStore)
                                            <option value="{{$atrophyStore->store_room_id}}">{{$atrophyStore->store_room_id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Số lượng</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-database"></i>
                                            </span>
                                            <input type="number" value="{{$atrophyStores[0]->quantity}}" min="1" name="quantity" class="form-control pull-right">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Ghi chú</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sticky-note"></i>
                                            </span>
                                            <input type="text" name="note" class="form-control pull-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">OK</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <!-- /.col (left) -->
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Thiết bị chờ thanh lí</h3>
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
                            <td>{{$liquidation->storeRoom->date_import}}</td>
                            <td>{{$liquidation->storeRoom->stuff->name}}</td>
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

