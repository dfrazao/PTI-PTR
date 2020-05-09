<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <link href="/fontawesome-pro-5.12.0-web/css/all.css" rel="stylesheet">
    <script src="/ckeditor5/build/ckeditor.js"></script>
    <script src='https://momentjs.com/downloads/moment-with-locales.js'></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />--}}
    <link rel="shortcut icon" href="/images/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 100%;
            background: #eee;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #2c3fb1;z-index: 1;">

        <!-- Left Side Of Navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/">
            <div>
                <img src="/images/logo1.png" style="width: 150px; height: 50px;">
            </div>
        </a>

        <!-- Right Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <ul class="nav navbar-nav navbar-right pr-5 m-2 my-lg-0 align-items-center">

                @guest

                @else
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa fa-bell"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="chat_button" onclick="chat()"><i class="fa fa-envelope"></i></a>
                    </li>

                    <script>
                        function chat() {
                            var x = document.getElementById("testee");
                            if (x.style.display === "block") {
                                x.style.display = "none";
                            } else {
                                x.style.display = "block";
                            }
                        }
                    </script>

                    @if ( Config::get('app.locale') == 'en')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span> English</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown09">
                                <a class="dropdown-item" href="{{ route('set.language', 'pt') }}"><span class="flag-icon flag-icon-pt"> </span> Portuguese</a>
                            </div>

                        </li>
                    @elseif ( Config::get('app.locale') == 'pt')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-pt"> </span> Portuguese</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown09">
                                <a class="dropdown-item" href="{{ route('set.language', 'en') }}"><span class="flag-icon flag-icon-us"> </span> English</a>
                            </div>

                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/profile/{{ Auth::user()->id }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.Auth::user()->photo)}}"> <span style="vertical-align: middle;">{{ Auth::user()->name }}</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest

            </ul>
        </div>
    </nav>

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: 500px;
        }
        .user {
            border-bottom: 1px solid #e7ebee;
            cursor: pointer;
            padding: 5px 0;
            position: relative;
            width: 100%;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width:40px;
            border:3px solid #fff;
            border-radius:50%;
        }
        .media-body p {
            margin: 6px 0;
            font-size: 12px;
        }
        .message-wrapper {
            padding: 10px;
            height: 400px;
            background: #ffffff;
        }
        .messages .message {
            margin-bottom: 15px;
            font-size: 12px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            overflow-wrap: break-word;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #4dff4d ;
        }
        .sent {
            background: #eceff1;
            float: right;
            text-align: right;
        }
        .message p {
            margin: 5px 0;
        }
        .date {
            color: black;
            opacity: 0.8;
            font-size: 10px;
        }
        .active {
            background: #eeeeee;
        }
        .col-sm-4 {
            padding: 0;
            overflow-x: hidden;
        }
        .col-sm-8 {
            padding: 0;
        }
        .nopadding {
            padding: 0 !important;
            margin: 0 !important;
        }
        #name{
            width: 100%;
            height: 47px;
            padding: 15px 29px;
            background-color: #eceff1;
        }

        .input_msg_write input {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            color: #4c4c4c;
            font-size: 15px;
            min-height: 48px;
            width: 100%;
        }

        .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
        .msg_send_btn {
            background: #05728f none repeat scroll 0 0;
            border: medium none;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            height: 33px;
            position: absolute;
            right: 0;
            top: 11px;
            width: 33px;
        }

        #name p{
            font-size: 15px;
            text-align: center;
        }

        @media screen and (max-width: 800px) {
            .container-md{
                width: 200px;
            }
            .col-md-4{
                width: 100%; /* The width is 100%, when the viewport is 800px or smaller */
                overflow-x: hidden;
            }
            .message p {
                margin: 5px 0;
                font-size: 12px;
            }
            .media-body p {
                margin: 6px 0;
                font-size: 12px;
            }
            .col-sm-4 {
                height: 300px;
            }
            .col-sm-8 {
                height: 300px;
            }
        }
    </style>
@yield('content')

    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>

    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('ff4af21336ebee3e83fe', {
                cluster: 'eu'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('pusher:subscription_succeeded', function(data) {

            });


            $(document).on('keyup', '.input-text input', function (e) {
                var message = $(this).val();
                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty
                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                    $.ajax({
                        type: "get",
                        url: "message/" + receiver_id, // need to create this route
                        data: "",
                        cache: false,
                        success: function (data) {
                            $('#messages').html(data);
                            scrollToBottomFunc();
                        }
                    });
                }
            });

            $(document).on('click', '.send_btn', function () {
                var message = $('.input-text input').val();
                // check if enter key is pressed and message is not null also receiver is selected
                if (message != '' && receiver_id != '') {
                    $('.input-text input').val(''); // while pressed enter text box will be empty
                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                    $.ajax({
                        type: "get",
                        url: "message/" + receiver_id, // need to create this route
                        data: "",
                        cache: false,
                        success: function (data) {
                            $('#messages').html(data);
                            scrollToBottomFunc();
                        }
                    });
                }
            });
            // make a function to scroll down auto
            function scrollToBottomFunc() {
                $('.message-wrapper').animate({
                    scrollTop: $('.message-wrapper').get(0).scrollHeight
                }, 50);
            }

            $("body").on( "click", '.user', function( event ){
                $('.user').removeClass('active');
                $(this).addClass('active');


                $(this).find('.pending').remove();
                receiver_id = $(this).attr('id');
                receiver_name = $(this).attr('name');
                $("#name").html(receiver_name);
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
                $('.input-text').css("display", "block");
                $('.input-group-append').css("display", "block");
            });
        });




    </script>
</body>
</html>
