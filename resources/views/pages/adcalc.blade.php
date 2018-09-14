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
    
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/jquery.bootstrap.year.calendar.css') }}">

    <!--   <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
   

    // <script src="{{ asset('js/app.js') }}" defer></script> -->





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
                      
                                   @include('pages.adcalc_content')

                            </div>
                            @include('footer')

                        </div>



   </body>


</html>


        