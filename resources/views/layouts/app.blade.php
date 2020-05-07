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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
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

                    {{--<li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif--}}

                @else
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa fa-bell"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="chat_button" onclick="chat()"><i class="fa fa-envelope"></i></a>
                    </li>

                    <script>
                        function chat() {
                            var x = document.getElementById("chatbox");
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

{{--    <style>
        #view-code:hover{opacity:1;}
        #chatbox{
            margin-right: 5%;
            display: none;
            float: right;
            z-index: 9999;
            position: relative;
            width:290px;
            background:white;
            border-radius:6px;
            border: black 1px solid;
            overflow:hidden;
            height:484px;
        }

        #friendslist{
            width:290px;
            height: 484px;

        }

        #friends{
            height: 75%;
            position: absolute;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        #cabecalho{
            position: relative;
        }


        #topmenu{
            height:69px;
            width:290px;
            border-bottom:1px solid #d8dfe3;
        }
        #topmenu span{
            float:left;
            width: 96px;
            height: 70px;
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/top-menu.png") -3px -118px no-repeat;
        }
        #topmenu span.friends{margin-bottom:-1px;}
        #topmenu span.chats{background-position:-95px 25px; cursor:pointer;}
        #topmenu span.chats:hover{background-position:-95px -46px; cursor:pointer;}
        #topmenu span.history{background-position:-190px 24px; cursor:pointer;}
        #topmenu span.history:hover{background-position:-190px -47px; cursor:pointer;}
        .friend{
            border-bottom:1px solid #e7ebee;
            position:relative;
        }
        .friend:hover{
            background:#f1f4f6;
            cursor:pointer;
        }
        .friend img{
            width:40px;
            border-radius:50%;
            margin-left: 10px;
            margin-top: 5px;
            float:left;
            position: relative;
        }

        .floatingImg{
            width:40px;
            border-radius:50%;
            position:absolute;
            top:0;
            left:12px;
            border:3px solid #fff;
        }
        .friend p{
            padding:5px 0 0 0;
            float:left;
            width:220px;
        }
        .col-sm-9{
            margin-top: 10px;
        }
        .col-sm-3{
            margin-top: 10px;
        }
        .friend .row .col-sm-9 strong{
            margin-top: 10%;
            font-weight:600;
            color:#597a96;

        }
        .friend .row .col-sm-9 p{
            font-size:13px;
            font-weight:400;
            color:#aab8c2;
        }

        .friend .status{
            background:#26c281;
            border-radius:50%;
            width:9px;
            height:9px;
            position:absolute;
            top:31px;
            right:17px;
        }
        .friend .status.away{background:#ffce54;}
        .friend .status.inactive{background:#eaeef0;}
        #search{
            background:#e3e9ed url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/search.png") -11px 0 no-repeat;
            height:60px;
            width:290px;
            position:relative;
            bottom:0;
            left:0;
        }
        #searchfield{
            background:#e3e9ed;
            margin:21px 0 0 55px;
            border:none;
            padding:0;
            font-size:14px;

            font-weight:400px;
            color:#8198ac;
        }
        #searchfield:focus{
            outline: 0;
        }
        #chatview{
            width:290px;
            height:484px;
            position:absolute;
            top:0;
            left:0;
            display:none;
            background:#fff;
        }
        #profile{
            overflow:hidden;
            text-align:center;
            color:#0000000;
        }
        .p1 #profile{
            background:#007bff40 0 0 no-repeat;

        }
        #profile .avatar{
            width:68px;
            border:3px solid #fff;
            margin:23px 0 0;
            border-radius:50%;
        }
        #profile  p{
            font-weight:600;
            font-size:15px;
            margin:118px 0 -1px;
            opacity:0;
            -webkit-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -moz-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -ms-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -o-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
        }
        #profile  p.animate{
            margin-top:97px;
            margin-bottom:10px;

            opacity:1;
            -webkit-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -moz-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -ms-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -o-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
        }
        #profile  span{
            font-weight:400;
            font-size:11px;
        }
        #chat-messages{
            opacity:0;
            margin-top:30px;
            width:290px;
            height:270px;
            overflow-y:scroll;
            overflow-x:hidden;
            padding-right: 20px;
            -webkit-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -moz-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -ms-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -o-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
        }
        #chat-messages.animate{
            opacity:1;
            margin-top:0;
        }
        #chat-messages label{
            color:#aab8c2;
            font-weight:600;
            font-size:12px;
            text-align:center;
            margin:15px 0;
            width:290px;
            display:block;
        }
        #chat-messages div.message{
            padding:0 0 30px 58px;
            clear:both;
            margin-bottom:45px;
        }
        #chat-messages div.message.right{
            padding: 0 58px 30px 0;
            margin-right: -19px;
            margin-left: 19px;
        }
        #chat-messages .message img{
            float: left;
            margin-left: -38px;
            border-radius: 50%;
            width: 30px;
            margin-top: 12px;
        }
        #chat-messages div.message.right img{
            float: right;
            margin-left: 0;
            margin-right: -38px;
        }
        .message .bubble{
            background:#f0f4f7;
            font-size:13px;
            font-weight:600;
            padding:12px 13px;
            border-radius:5px 5px 5px 0px;
            color:#8495a3;
            position:relative;
            float:left;
        }
        #chat-messages div.message.right .bubble{
            float:right;
            border-radius:5px 5px 0px 5px ;
        }
        .bubble .corner{
            background:url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/bubble-corner.png") 0 0 no-repeat;
            position:absolute;
            width:7px;
            height:7px;
            left:-5px;
            bottom:0;
        }
        div.message.right .corner{
            background:url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/bubble-cornerR.png") 0 0 no-repeat;
            left:auto;
            right:-5px;
        }
        .bubble span{
            color: #aab8c2;
            font-size: 11px;
            position: absolute;
            right: 0;
            bottom: -22px;
        }
        #sendmessage{
            height:60px;
            border-top:1px solid #e7ebee;
            position:absolute;
            bottom:0;
            right:0px;
            width:290px;
            background:#fff;
            padding-bottm:50px;
        }
        #sendmessage input{
            border
        }
        #sendmessage input{
            background:#fff;
            margin:21px 0 0 21px;
            border:none;
            padding:0;
            font-size:14px;
            font-weight:400px;
            color:#aab8c2;
        }
        #sendmessage input:focus{
            outline: 0;
        }
        #sendmessage button{
            background:#fff url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/send.png") 0 -41px no-repeat;
            width:30px;
            height:30px;
            position:absolute;
            right: 15px;
            top: 23px;
            border:none;
        }
        #sendmessage button:hover{
            cursor:pointer;
            background-position: 0 0 ;
        }
        #sendmessage button:focus{
            outline: 0;
        }

        #close{
            position:absolute;
            top: 8px;
            opacity:0.8;
            right: 10px;
            width:20px;
            height:20px;
            cursor:pointer;
        }
        #close:hover{
            opacity:1;
        }
        .cx, .cy{
            background:black;
            position:absolute;
            width:0px;
            top:15px;
            right:15px;
            height:3px;
            -webkit-transition: all 250ms ease-in-out;
            -moz-transition: all 250ms ease-in-out;
            -ms-transition: all 250ms ease-in-out;
            -o-transition: all 250ms ease-in-out;
            transition: all 250ms ease-in-out;
        }
        .cx.s1, .cy.s1{
            right:0;
            width:20px;
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }
        .cy.s2{
            -ms-transform: rotate(50deg);
            -webkit-transform: rotate(50deg);
            transform: rotate(50deg);
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }
        .cy.s3{
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }
        .cx.s1{
            right:0;
            width:20px;
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }
        .cx.s2{
            -ms-transform: rotate(140deg);
            -webkit-transform: rotate(140deg);
            transform: rotate(140deg);
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }
        .cx.s3{
            -ms-transform: rotate(135deg);
            -webkit-transform: rotate(135deg);
            transform: rotate(135deg);
            -webkit-transition: all 100ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }
        #chatview, #sendmessage {
            overflow:hidden;
            border-radius:6px;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <script>
        $(document).ready(function() {
            var preloadbg = document.createElement("img");
            preloadbg.src = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/timeline1.png";

            $("#searchfield").focus(function () {
                if ($(this).val() == "Search contacts...") {
                    $(this).val("");
                }
            });
            $("#searchfield").focusout(function () {
                if ($(this).val() == "") {
                    $(this).val("Search contacts...");

                }
            });

            $("#sendmessage input").focus(function () {
                if ($(this).val() == "Send message...") {
                    $(this).val("");
                }
            });
            $("#sendmessage input").focusout(function () {
                if ($(this).val() == "") {
                    $(this).val("Send message...");

                }
            });


            $(".friend").each(function () {
                $(this).click(function () {
                    var childOffset = $(this).offset();
                    var parentOffset = $(this).parent().parent().offset();
                    var childTop = childOffset.top - parentOffset.top;
                    var clone = $(this).find('img').eq(0).clone();
                    var top = childTop + 12 + "px";
                    var clonename = $(this).find('strong').eq(0).clone();



                    $(clone).css({'top': top}).addClass("floatingImg").appendTo("#chatbox");

                    setTimeout(function () {
                        $("#profile p").addClass("animate");
                        $("#profile").addClass("animate");
                    }, 100);
                    setTimeout(function () {
                        $("#chat-messages").addClass("animate");
                        $('.cx, .cy').addClass('s1');
                        setTimeout(function () {
                            $('.cx, .cy').addClass('s2');
                        }, 100);
                        setTimeout(function () {
                            $('.cx, .cy').addClass('s3');
                        }, 200);
                    }, 150);

                    $('.floatingImg').animate({
                        'width': "68px",
                        'left': '108px',
                        'top': '20px'
                    }, 200);

                    var name = $(this).find("p strong").html();
                    var email = $(this).find("p span").html();
                    $("#profile p").html(name);
                    $("#profile span").html(email);

                    $(".message").not(".right").find("img").attr("src", $(clone).attr("src"));
                    $('#friendslist').fadeOut();
                    $('#chatview').fadeIn();


                    $('#close').unbind("click").click(function () {
                        $("#chat-messages, #profile, #profile p").removeClass("animate");
                        $('.cx, .cy').removeClass("s1 s2 s3");
                        $('.floatingImg').animate({
                            'width': "40px",
                            'top': top,
                            'left': '12px'
                        }, 200, function () {
                            $('.floatingImg').remove()
                        });

                        setTimeout(function () {
                            $('#chatview').fadeOut();
                            $('#friendslist').fadeIn();
                        }, 50);
                    });

                });
            });
        });

    </script>--}}
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
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
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
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
    </style>
@yield('content')

    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
                receiver_id = $(this).attr('id');
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
                }
            });
        });
        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
    </script>
</body>
</html>
