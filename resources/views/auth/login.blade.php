@include ('layouts.header_lib')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}"><b>Quản lí</b> TSCĐ</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Mời bạn đăng nhập</p>

            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" placeholder="Email">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input type="password" name="password" required class="form-control" placeholder="Password">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-offset-1">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

<!--            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>-->
            <br>

        </div>
    </div>

    @include ('layouts.footer_lib')


