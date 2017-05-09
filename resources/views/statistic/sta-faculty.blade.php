@extends('layouts.template_admin')

@section('title_content')
Thống kê tài sản theo khoa
@stop

@section('home')
<li>Thống kê</li>
<li class="active">TK khoa</li>
@stop

@section('content')

<div class="box">
    <form class="form-horizontal" role="form" method="POST" action="{{route('statis-faculty-by-year')}}">
        {{ csrf_field() }}
        <div class="box-header">
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn năm</label>
                <div class="col-sm-6">
                    <select name="year" class="form-control">
                        @for($i = $years['min']; $i <= $years['max']; $i++)
                        <option {{!isset($years['now']) ? '' : ($years['now'] == $i ? "selected" : '')}} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div><div class="col-sm-2">
                    <button type="submit" class="btn btn-info pull-right import_faculty-btn">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="box">
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên tài sản</th>
                    <th>Thông số</th>
                    <th>SL nhập</th>
                    <th>SL tồn kho</th>
                    <th>SL thanh lí</th>
                    <th></th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($importFacs as $key => $importFac)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$importFac->stuff->name}}</td>
                    <td>{{$importFac->stuff->supplier->name}}</td>
                    <td>{{$importFac->quantity_start}}</td>
                    <td>{{$importFac->quantity}}</td>
                    <td>{{$importFac->liquidation}}</td>
                    <td>
                        <a href="{{url('fac/statis-faculty-year-detail', [$years['now'], $importFac->stuff_id])}}" class="bg-gray-light margin">
                            <i class="fa fa-angle-double-right"></i>
                            Chi tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>


@stop

