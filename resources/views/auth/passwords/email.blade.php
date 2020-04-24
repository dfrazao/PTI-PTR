@extends('layouts.app')
@section('content')
<head>
    <title>Reset Password</title>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-3">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h2 class="text-center">{{ __('Reset Password') }}</h2>
            <hr style="border-top: 1px solid black; width: 100%;">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        {{--<label for="email" class=" col-form-label ">{{ __('E-Mail Address') }}</label>--}}
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <hr style="border-top: 1px solid black; width: 100%;">
                <div class="form-group row mb-0 text-center">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary col-md-12" style="background:#2c3fb1">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
