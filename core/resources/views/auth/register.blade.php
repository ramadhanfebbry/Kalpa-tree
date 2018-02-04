@extends('layouts.auth.frame')

@section('content')
<div class="login-container bg-white">
    <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-0 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
        <img alt="logo" data-src="{{url('img/logo.png')}}" data-src-retina="{{url('img/logo_2x.png')}}" height="22" src="{{url('img/logo.png')}}" width="78">
        <p class="p-t-35">Register your extranet panel account</p>
        <form class="" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} form-group-default input-xs">
                <label for="name">Name</label>

                <div class="controls">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>
            </div>
            @if ($errors->has('name'))
                <label class="error help-block">
                    <small>{{ $errors->first('name') }}</small>
                </label>
            @endif

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} form-group-default input-xs">
                <label for="username">Username</label>

                <div class="controls">
                    <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required>
                </div>
            </div>
            @if ($errors->has('username'))
                <label class="error help-block">
                    <small>{{ $errors->first('username') }}</small>
                </label>
            @endif

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group-default input-xs">
                <label for="email">E-Mail Address</label>

                <div class="controls">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
            </div>
            @if ($errors->has('email'))
                <label class="error help-block">
                    <small>{{ $errors->first('email') }}</small>
                </label>
            @endif


            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-group-default input-xs">
                <label for="password">Password</label>

                <div class="controls">
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
            </div>
            @if ($errors->has('password'))
                <label class="error help-block">
                    <small>{{ $errors->first('password') }}</small>
                </label>
            @endif

            <div class="form-group form-group-default input-xs">
                <label for="password-confirm" >Confirm Password</label>

                <div class="controls">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="checkbox check-success">
                        <input id="checkbox-agree" type="checkbox" name="remember" required checked> <label for="checkbox-agree">Keep Me Signed in</label>
                    </div>
                </div>
            </div><button class="btn btn-primary btn-cons m-t-10" type="submit">Register</button>

        </form>
        <div class="pull-bottom sm-pull-bottom">
            <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                <div class="col-sm-12 no-padding m-t-10">
                    <p><small>If you have any problem with your account, please contact your technical support, <a class="text-success" href="{{ url('/login') }}">
                                    Login?
                                </a></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
