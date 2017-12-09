@extends('layouts.master')

@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container">
    <h3>Login</h3>

    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-row{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>

        <div class="form-row  submit">
            <button type="submit" class="submit">
                Login
            </button>
        </div>

        <div class="form-row">
            <a href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
        <div class="form-row">
            <a href="{{ route('register') }}">
                Register as a new User
            </a>
        </div>
    </form>
</div>
@endsection
