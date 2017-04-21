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





@stop