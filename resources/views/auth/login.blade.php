@extends('layouts.app')
@section('content')
<div class="container full-height">
    <h1 class="pt-5 text-center">Login</h1>

    <div class="container" style="width: 35%;">
        <hr style="border-top: 1px solid black; width: 100%;">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ __('Password') }}" name="password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group form-check text-center" style="font-size: 13px;">
                <label class="pr-3 form-check-label" style="border-right: 1px solid black;">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>

                <label class="pl-3" >
                    @if (Route::has('password.request'))
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </label>

            </div>

            <hr style="border-top: 1px solid black; width: 100%;">
            <div class="text-center">
                <button type="submit" class="btn btn-primary" style="background:#2c3fb1; width: 47.5%;">
                    {{ __('Login') }}
                </button>
                <button type="button" class="btn btn-primary" style="background:white; color: black; width: 47.5%;">Clear</button>
            </div>

        </form>
    </div>
</div>
@endsection
