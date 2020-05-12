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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.3/min/moment-with-locales.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.3/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{asset('css/emojionearea.min.css')}}"/>
    <script type="text/javascript" src="{{asset('js/emojionearea.min.js')}}"></script>

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
<script>
    moment.locale("{{ str_replace('_', '-', app()->getLocale()) }}");
</script>
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



@yield('content')

</body>
</html>
