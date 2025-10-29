@extends('layouts.guest')

@section('content')
    <div class="login-container">
        <div class="login-header">
            <h1 class="login-box-msg">System Login</h1>
        </div>

        <form action="{{ route('login.post') }}" method="post" autocomplete="on">
            @csrf
            
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="form-control-custom @error('email') is-invalid @enderror" placeholder="{{ __('email') }}">
                @error('email')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" class="form-control-custom @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                @error('password')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
           <!-- <div class="form-options">
                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                @endif
            </div>-->

            <div class="form-group">
                <button type="submit" class="btn-signin">{{ __('Sign In') }}</button>
            </div>
        </form>
    </div>
@endsection