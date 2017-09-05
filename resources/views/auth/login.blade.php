@extends('layouts.login_register.login_register')

@section('content')
<div class="container">
    <div class="row auth-box">
        <div class="col-md-8 col-md-offset-2">
            <div class="registration-login-panel">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">Welcome Back</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-success ">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        Forgot Your Password?
                                    </a>

                                    <a class="btn btn-link" href="{{ route('auth.activate.resend') }}">
                                        resend activation link
                                    </a>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="social-login text-center">
                            <button class="btn btn-primary"><i class="fa fa-facebook"></i> login with facebook</button>
                            <button class="btn btn-warning"><i class="fa fa-twitter"></i> login with twitter</button>
                            <button class="btn btn-danger"><i class="fa fa-google"></i> login with google</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
