
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
                 <a href="#">DE</a>
                  <a href="#" class="active">EN</a>
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



