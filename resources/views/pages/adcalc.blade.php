<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
     <!--  <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/jquery.bootstrap.year.calendar.css"> -->


      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/jquery.bootstrap.year.calendar.css') }}">


      <title>ADCALC</title>
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
