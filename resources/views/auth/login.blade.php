@extends('layouts.app')
@section('content')
<head>
    <title>Login</title>
</head>
<div class="container">
    <div class="row justify-content-center rounded">
        <div class="col-md-4 mt-3">
            <h2 class="text-center">Login</h2>
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

                    <div class="row p-0 m-0 text-center" style="font-size: 13px;">
                        <div class="col-sm-6">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </div>
                        <style>
                            @media (min-width: 576px) {
                                .vl {
                                border-left: 1px solid black;
                                height: 20px;
                                }
                            }
                        </style>

                         <div class="col-sm-6 vl">
                                <a class="" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                        </div>
                    </div>

                    <hr style="border-top: 1px solid black; width: 100%;">
                    <div class="form-group row mb-0 text-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mb-2" style="background:#2c3fb1; width: 100%;">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary clear" style="background:white; color: black; width: 100%;">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".clear").click(function(){
        $("#email").val('');
        $("#password").val('');
    });
</script>
@endsection
