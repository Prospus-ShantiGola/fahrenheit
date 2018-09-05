<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('images/cropped-flake-32x32.png') }}" >

        <title>FAHRENHEIT</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <style>
        .hide{
            display: none;
        }
    </style>
    </head>
    <body>

                    @include('header')
                    <div class="content">
                            <div class="title m-b-md">
                                    @include('content')
                            </div>
                            @include('footer')

                        </div>



        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">
                        <form id="login-form" method="post" onsubmit="return LoginUser()" role="form" style="display: block;">
                            @csrf


                            <div class="form-group row">

                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>


                                        <span class="invalid-feedback invalid-login hide" role="alert">
                                            <strong></strong>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function LoginUser()
            {
                var token    = $("input[name=_token]").val();
                var email    = $("input[name=email]").val();
                var password = $("input[name=password]").val();
                var data = {
                    _token:token,
                    email:email,
                    password:password
                };
                // Ajax Post
                $.ajax({
                    type: "post",
                    url: "/users/loginUser",
                    data: data,
                    cache: false,
                    success: function (data)
                    {
                        if(data.status=="success"){
                            window.location.href="/user_reports";
                        }
                        else{
                            $("input[name=email]").addClass('is-invalid');
                            $(".invalid-login strong").removeClass('hide').text(data.message);
                        }
                    },
                    error: function (data){
                        alert('Fail to run Login..');
                    }
                });
                return false;
            }
            //# sourceURL=user.js
        </script>
    </body>


</html>
