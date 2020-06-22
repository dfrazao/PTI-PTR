<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="GroupX - Plataforma de suporte para trabalhos e projetos de grupo no âmbito do ensino superior.">
    <meta name="keywords" content="groupx, grupo, trabalho, projeto, universidade, faculdade, ensino superior">
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <link href="/fontawesome-pro-5.12.0-web/css/all.css" rel="stylesheet">
    <script src="/ckeditor5/build/ckeditor.js"></script>
    <script src='https://momentjs.com/downloads/moment-with-locales.js'></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.3/min/moment-with-locales.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.3/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{asset('css/emojionearea.min.css')}}"/>
    <script type="text/javascript" src="{{asset('js/emojionearea.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.css">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        html {
            height: 100%;
        }

        body {
            min-height: 100%;
            position:relative;
            margin: 0;
        }

        .padding {
            padding-bottom: 65px;    /* height of footer */
        }

        .footer {
            height: 65px;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            background-color: #898989;
            color: white;
            text-align: center;
            margin-top: 1%;
        }
    </style>
</head>
<script>
    moment.locale("{{ str_replace('_', '-', app()->getLocale()) }}");
</script>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #2c3fb1;z-index: 3;">

        <!-- Left Side Of Navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @guest
            <a class="navbar-brand" href="/">
        @else
            <a class="navbar-brand" href="{{(Auth::user()->role == "admin" ? '/admin/':'/')}}">
        @endguest
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
                    @if(Auth::user()->role != "admin")

                        <li class="nav-item dropdown dropdown-notifications">
                            @if (Auth::user()->unreadNotifications->count() === 0)

                            <a id="notifications" href="#notifications-panel" class="nav-link" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                            </a>

                            @else
                                <a id="notifications" href="#notifications-panel" class="nav-link" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i><span class='pending_not'></span>
                                </a>

                            @endif
                            <div class="dropdown-container" >
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuOffset" style="max-height: 400px; overflow-y: scroll;" >
                                    @foreach(Auth::user()->Notifications as $notification)
                                        @if($notification->unread())

                                            @if(Auth::user()->role == "student")
                                                    <a class="dropdown-item" href="/student/project/{{$notification->data['idProject']}}" style="padding: 5px; !important; background: rgba(255,80,95,0.23); ">
                                            @elseif(Auth::user()->role == "professor")
                                                    <a class="dropdown-item" href="/professor/project/{{$notification->data['idProject']}}" style="padding: 5px; !important; background: rgba(255,80,95,0.23); ">
                                            @endif
                                                <div class="media">
                                                    <div class="media-left">
                                                        <div class="media-object">

                                                            <script>
                                                                $('#notifications').click(function () {
                                                                    $('.pending_not').remove();
                                                                    <?php
                                                                    $usernot = \App\User::find($notification->data['user_id']);
                                                                    $notification->markAsRead();
                                                                    ?>

                                                                });
                                                            </script>
                                                            <img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$usernot->photo)}}">
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="notification-title">{{$usernot->name}}</span> <small> - {{$notification->created_at->diffForHumans()}}</small>
                                                        <p class="notification-desc">{{$notification->data['action']}} on {{$notification->data['projectName']}} - {{$notification->data['subject']}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            @if(Auth::user()->role == "student")
                                                <a class="dropdown-item" href="/student/project/{{$notification->data['idProject']}}" style="padding: 5px; !important;  ">
                                            @elseif(Auth::user()->role == "professor")
                                                    <a class="dropdown-item" href="/professor/project/{{$notification->data['idProject']}}" style="padding: 5px; !important;  ">
                                            @endif
                                                <div class="media" style="padding: 3px;">
                                                    <div class="media-left">
                                                        <div class="media-object">
                                                            <?php
                                                            $usernot = \App\User::find($notification->data['user_id']);
                                                            $notification->markAsRead();
                                                            ?>
                                                            <script>
                                                                $('#notifications').click(function () {
                                                                    $('.pending_not').remove();
                                                                });
                                                            </script>
                                                            <img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$usernot->photo)}}">
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="notification-title">{{$usernot->name}}</span><small> - {{$notification->created_at->diffForHumans()}}</small>
                                                        <p class="notification-desc">{{$notification->data['action']}} on {{$notification->data['projectName']}} - {{$notification->data['subject']}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                            @endif

                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @if ($notification_chat === 0)
                            <li class="nav-item dropdown dropdown-notifications">
                                <a class="nav-link" id="chat_button" onclick="chat()"><i class="fa fa-envelope"></i></a>
                            </li>

                    @else
                        <script>
                            sessionStorage.setItem("not", {{$notification_chat}});
                        </script>
                            <li class="nav-item dropdown dropdown-notifications">
                                <a class="nav-link " id="chat_button" onclick="chat()"><i class="fa fa-envelope"></i><span class='pending_nav'></span></a>
                            </li>
                    @endif
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
                        @endif
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
                        @if(Auth::user()->role == "student")
                            <li class="nav-item">
                                <a class="nav-link" href="/profile/{{ Auth::user()->id }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.Auth::user()->photo)}}"> <span style="vertical-align: middle;">{{ Auth::user()->name }}</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                            @if(request()->path() == "/")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#modalHelpDashboardStudent" role="button" aria-haspopup="true" aria-expanded="false" v-pre> <span style="vertical-align: middle;"><i class="fa fa-question-circle" style="font-size: 1em"></i></span></a>
                                </li>


                            @elseif(request()->segment(4)  == "groups")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#modalHelpGroupsStudent" role="button" aria-haspopup="true" aria-expanded="false" v-pre> <span style="vertical-align: middle;"><i class="fa fa-question-circle" style="font-size: 1em"></i></span></a>
                                </li>
                            @elseif(request()->segment(2)  == "project")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#modalHelpProjectStudent" role="button" aria-haspopup="true" aria-expanded="false" v-pre> <span style="vertical-align: middle;"><i class="fa fa-question-circle" style="font-size: 1em"></i></span></a>
                                </li>
                            @elseif(request()->segment(1)  == "profile")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#modalHelpProfile" role="button" aria-haspopup="true" aria-expanded="false" v-pre> <span style="vertical-align: middle;"><i class="fa fa-question-circle" style="font-size: 1em"></i></span></a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="/profile/{{ Auth::user()->id }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.Auth::user()->photo)}}"> <span style="vertical-align: middle;">{{ Auth::user()->name }}</span></a>
                                </li>

                            @endif
                        @elseif(Auth::user()->role == "professor")

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
                            @if(request()->path() == "/")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#modalHelpDashboardProfessor" role="button" aria-haspopup="true" aria-expanded="false" v-pre> <span style="vertical-align: middle;"><i class="fa fa-question-circle" style="font-size: 1em"></i></span></a>
                                </li>
                            @elseif(request()->segment(1)  == "profile")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#modalHelpProfile" role="button" aria-haspopup="true" aria-expanded="false" v-pre> <span style="vertical-align: middle;"><i class="fa fa-question-circle" style="font-size: 1em"></i></span></a>
                                </li>
                            @elseif(request()->segment(2)  == "project")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#modalHelpProjectprofessor" role="button" aria-haspopup="true" aria-expanded="false" v-pre> <span style="vertical-align: middle;"><i class="fa fa-question-circle" style="font-size: 1em"></i></span></a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" role="button" aria-haspopup="true" aria-expanded="false" v-pre><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.Auth::user()->photo)}}"> <span style="vertical-align: middle;">{{ Auth::user()->name }}</span></a>
                                </li>
                            @endif
                        @endif
                @endguest

            </ul>
        </div>
    </nav>
    <div id="modalHelpProfile" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.help')}}</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <dl>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.profile')}}</h5></dt>
                        <dd>{{__('gx.helpProf')}}</dd>

                    </dl>
                </div>
                <div class="modal-footer">

                </div>
            </div>
            <<<<<<< HEAD
        </div>
    </div>
    <div id="modalHelpDashboardStudent" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.help')}}</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <dl>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.calendar')}}</h5></dt>
                        <dd>{{__('gx.helpDashStudent')}}</dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.subjects')}}</h5></dt>
                        <dd>{{__('gx.helpDashStudent2')}}</dd>
                    </dl>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div id="modalHelpProjectStudent" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.help')}}</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <dl>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.content')}}</h5></dt>
                        <dd>{{__('gx.helpProjectStud')}}</dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.schedule')}}</h5></dt>
                        <dd>{{__('gx.helpProjectStud2')}}</dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.forum')}}</h5></dt>
                        <dd>{{__('gx.helpProjectStud3')}} </dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.submission')}}</h5></dt>
                        <dd>{{__('gx.helpProjectStud4')}}</dd>
                    </dl>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>




    <div id="modalHelpGroupsStudent" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.help')}}</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <dl>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.join group')}}</h5></dt>
                        <dd>{{__('gx.helpGroupStud2')}}</dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.create group')}}</h5></dt>
                        <dd>{{__('gx.helpGroupStud')}}</dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.student sugestions')}}</h5></dt>
                        <dd>{{__('gx.helpGroupStud3')}}</dd>
                    </dl>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <div id="modalHelpDashboardProfessor" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.help')}}</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <dl>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.calendar')}}</h5></dt>
                        <dd>{{__('gx.helpDashStudent')}}</dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.subjects')}}</h5></dt>
                        <dd>{{__('gx.helpDashboardProf')}}</dd>
                    </dl>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <div id="modalHelpProjectprofessor" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.help')}}</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <dl>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.characteristics')}}</h5></dt>
                        <dd>{{__('gx.helpProjectProf')}}</dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.groups')}}</h5></dt>
                        <dd>{{__('gx.helpProjectProf2')}} </dd><br>
                        <dt><h5 class="text-light bg-secondary rounded" style="width:fit-content;padding-right:0.5%;padding-left:0.5%">{{__('gx.forum')}}</h5></dt>
                        <dd>{{__('gx.helpProjectProf3')}} </dd>

                    </dl>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>



    <div class="padding">
        @include('chat')
        @yield('content')
    </div>
<style>
    .pending_not {
        position: absolute;
        left: 20px;
        top: 7px;
        background: #ff505f;
        margin: 0;
        border-radius: 50%;
        width: 10px;
        height: 10px;
        line-height: 18px;
        padding-left: 5px;
        color: #ffffff;
        font-size: 12px;
    }
</style>
    <div class="footer p-2">
        <a class="p-1" style="color: white" href="mailto:ptiptr9@gmail.com"><u>{{__('gx.contact us')}}</u></a>
        <p class="p-0 m-0">&#169; {{__('gx.2020, allRightsReserved.')}} </p>
    </div>
</body>
</html>
