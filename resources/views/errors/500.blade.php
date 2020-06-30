@extends('layouts.app')
@section('content')
<head>
    <title>{{__('gx.server error')}}</title>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .code {
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref" style="height: 85vh;">
    <div class="code">
        500
    </div>

    <div class="message" style="padding: 10px;">
        {{__('gx.server error')}}
    </div>
</div>
@endsection
