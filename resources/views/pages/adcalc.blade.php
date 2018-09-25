<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('images/cropped-flake-32x32.png') }}" >

        <title>FAHRENHEIT</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

      <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/frontstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">

   <link rel="stylesheet" href="{{ asset('public/css/jquery.bootstrap.year.calendar.css') }}">

    <!--   <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">


    // <script src="{{ asset('public/js/app.js') }}" defer></script> -->



    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="{{ asset('public/js/script.js') }}" defer></script>



    <script src="{{ asset('public/js/jquery.scrollbar.js') }}" defer></script>
    <script src="{{ asset('public/js/Sortable.js') }}" defer></script>

    <style>
       /* .hide{
            display: none;
        }*/
    </style>
    <script>
       <?php
            if($user = Auth::user())
{ ?>

    LOGGED_IN_ROLE= "<?php echo (Auth::user()->user_type_id ==3) ? 'expert':'user' ;?>";
<?php
        } else {
            ?>

                LOGGED_IN_ROLE= "user";
            <?php
        }
?>
        GENERAL_TILE= "General Information";
       CHILLER_TITLE= "Compression Chiller";
       ECONOMIC_TITLE= "Economic Data";
       CHANGE_FORM=false;

    </script>
    </head>
    <body>

                    @include('header')
                    <div class="content">
                            <div class="title m-b-md">

                               @include('content')

                            </div>
                            @include('footer')

                        </div>



   </body>


</html>


