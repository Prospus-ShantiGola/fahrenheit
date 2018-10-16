<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('public/images/cropped-flake-32x32.png') }}" >

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fahrenehit') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="{{ asset('public/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery-simple-validator.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->

    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/frontstyle.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

</head>
<body>
    <div id="app">
            <section class="top-header">
                    <div class="container dashboardcontainer">
                        <div class="row">
                            <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6">
                                    @if (Route::has('login'))

                                        @auth
                                        <div class="loggedin-div">
                                                <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                        </div>
                                        @else
                                        <div class="login-div">
                                                <a href="#" data-toggle="modal" data-backdrop="false" data-target="#loginModal">Login</a>
                                        </div>
                                        @endauth
                                    @endif

                                <div class="language-change-div">

                                 <a href="{{ route('changelang','de')}}">DE</a>
                                  <a href="{{ route('changelang','en')}}">EN</a>

                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6">
                                <div class="header-search-form">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt="fahrenheit" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

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

                                    {{ Auth::user()->name }}

                                {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            <div class="container">
                    <div class="row justify-content-center">
                            <div class="card">
                                    <div class="card-header dashboard">Dashboard</div>

                                    <div class="card-body">
                                            <div class="row">
                                                    <div class="col-3 left-menu">
                                                        <div class="container-fluid left-panel menu">
                                                            <div>
                                                                    <a href="{{ route('user_reports.user_report.index') }}" title="Reports"> Projects </a>
                                                            </div>
                                                            @can('isAdmin')
                                                            <div>
                                                                <a href="{{ route('users.users.index') }}" title="Users"> User Settings </a>
                                                        </div>
                                                        <div>
                                                            <a href="#"  class="disabled" title="Management Settings">Management Settings</a>
                                                        </div>
                                                            @endcan
                                                            <div>
                                                                    <a href="{{ route('users.users.edit', Auth::id() ) }}"   title="My Profile">My Profile</a>
                                                                </div>

                                                          </div></div>
                                                    <div class="col-9">
                                                        <div class="container-fluid">
                                                            @yield('content')
                                                            </div>
                                                        </div>
                                                  </div>



        </div>
                            </div>
                    </div>
    </div>
        </main>
    </div>
    <script>
        var url =window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });
    </script>
</body>
</html>
