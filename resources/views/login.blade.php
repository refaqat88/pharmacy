@extends('layouts.auth')
@section('content')
    <div class="login-card">
        <h1>Login</h1><br>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="error alert alert-danger alert-block">
                {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form class="form" method="POST" action="{{ url('login') }}">
            @csrf
            <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="Username">
            {{--        <input id="username" type="text"--}}
            {{--               class="form-control @error('username') is-invalid @enderror" name="username"--}}
            {{--               value="{{ old('username') }}" placeholder="username"  autocomplete="username" autofocus>--}}
            @error('username')
            <span class="error invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password">

            @error('password')



            <span class="error invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror


            <input type="submit" style="margin-top:10px" name="login" class="login login-submit" value="login">
        </form>

        <div class="login-help">
            {{--        <a href="#">Register</a> • <a href="#">Forgot Password</a>--}}
        </div>
    </div>
@endsection