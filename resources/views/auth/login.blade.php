@extends('layouts.auth')

@section('title')
Login
@endsection

@section('login')
<div class="login-box">
    <div class="login-logo">
        <h2><b>Selamat Datang di</b></h2>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <div class="login-logo">
            <a href="{{ url('/') }}"><b>Company Name</b></a>
        </div>
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group has-feedback @error('email') has-error @enderror">
                <input type="email" name="email" class="form-control" placeholder="Email" required :value="{{ old('email') }}" value="">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group has-feedback @error('password') has-error @enderror">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <a href="#">I forgot my password</a><br>

    </div>
    <!-- /.login-box-body -->
</div>
@endsection