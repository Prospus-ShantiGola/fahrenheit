
<!--header start-->
<section class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-6">
                    @if (Route::has('login'))

                        @auth
                        <div class="loggedin-div">
                                <a href="{{ url('/user_reports') }}">Dashboard</a>
                        </div>
                        @else
                        <div class="login-div">
                                <a href="#" data-toggle="modal" data-backdrop="false" data-target="#loginModal">Login</a>
                        </div>
                        @endauth
                    @endif

                <div class="language-change-div">
                 <a href="#" class="disabled">DE</a>
                  <a href="#" class="disabled">EN</a>
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
<header>
    <div class="container">

        <div class="row">
            <div class="col-12 col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="header-logo">

                    <img src="{{ asset('images/logo.png') }}">
                </div>
            </div>
            <div class="col-12 col-md-9 col-sm-9 col-lg-9 col-xl-9">
                <div class="top-navigation">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item ">
                                    <a class="nav-link" href="">Adcalc</a>
                                </li>
                                <!-- <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Browse
                             </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action 1</a>
                                <a class="dropdown-item" href="#">Action 2</a>
                                <a class="dropdown-item" href="#">Action 3</a>
                             </div>
                          </li>-->

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header end-->
{{--  <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                    <a href="{{ route('register') }}" class="hide">Register</a>
                @endauth
            </div>
        @endif


    </div>  --}}



