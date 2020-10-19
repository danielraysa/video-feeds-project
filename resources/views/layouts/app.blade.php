<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title.' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.js" integrity="sha512-AgWDJkG13uHcgm8NoCl1qcTk5gml73x2ZAkIe7ljOgT/pRdYYLbcGG1cY8GDOEQt/se3kdBf8t6IaAl8XFPOiw==" crossorigin="anonymous"></script>
    <script src="https://zurb.github.io/tribute/example/tribute.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://zurb.github.io/tribute/example/tribute.css" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .stroke-transparent {
            -webkit-text-stroke: 1px #000;
        }
    </style>
    @stack('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">
            <div class="container">
                <a class="navbar-brand" @guest href="{{ url('/') }}" @else href="#" @endguest>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="@auth d-none d-sm-block @endauth">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{ (request()->is('search*')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('search') }}">Search</a>
                        </li>
                        <li class="nav-item {{ (request()->is('videos*')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('videos.index') }}">Video</a>
                        </li>
                    </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}"> Profile
                                    </a>
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
            </div>
        </nav>
        @auth
        <nav class="navbar navbar-dark bg-dark navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}"><i class="fas fa-home"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('search') }}" class="nav-link {{ (request()->is('search*')) ? 'active' : '' }}"><i class="fas fa-search"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('videos.index') }}" class="nav-link {{ (request()->is('videos*')) ? 'active' : '' }}"><i class="fas fa-video"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.show', Auth::user()->id) }}" class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}"><i class="fas fa-user"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link"><i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </nav>
        @endauth

        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>
    @stack('js')
</body>
</html>
