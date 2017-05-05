@extends('layouts.template_admin')

@section('title_content')
Trang cá nhân
@stop

@section('home')
<li class="active">Profile</li>
@stop

@section('content')

<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset(config('path.user').Auth::user()->avatar)}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{Auth::user()->lastname}} {{Auth::user()->firstname}}</h3>

                    <p class="text-muted text-center">{{Auth::user()->role->name}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Ngày sinh</b>
                            @if(Auth::user()->dob)
                            <p class="pull-right"><b>{{ Auth::user()->dob}}</b></p>
                            @else
                            <p class="pull-right"><i>Chưa cập nhật</i></p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> 
                            @if(Auth::user()->email)
                            <p class="pull-right"><b>{{ Auth::user()->email}}</b></p>
                            @else
                            <p class="pull-right"><i>Chưa cập nhật</i></p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b>
                            @if(Auth::user()->phone)
                            <p class="pull-right"><b>{{ Auth::user()->phone}}</b></p>
                            @else
                            <p class="pull-right"><i>Chưa cập nhật</i></p>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Khoa</b> 
                            <p class="pull-right"><b>{{Auth::user()->faculty->name }}</b></p>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
            </div>

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                    <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">

                    @include ('auth.user.activity')

                    <!-- /.tab-pane -->

                    @include ('auth.user.timeline')

                    <!-- /.tab-pane -->

                    @include ('auth.user.setting')

                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>

@stop