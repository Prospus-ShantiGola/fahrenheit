<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('public/images/cropped-flake-32x32.png') }}" >

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

<script src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyADkOuDbCZkoIvNvEw2BvLYcXOLjd-oAhQ"></script>

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
if($_SERVER['HTTP_HOST']=="localhost"){
    ?>
    // LOGGED_IN_ROLE = "expert";
    LOGGED_IN_ROLE = "expert";
    <?php
}
?>
GENERAL_TILE= "General Information";
CHILLER_TITLE= "Compression Chiller";
ECONOMIC_TITLE= "Economic Data";
HEAT_SOURCE_TITLE= "Heat Source";
HEAT_LOAD_PROFILE_TITLE= "Heating Load Profile";
COOLING_LOAD_PROFILE_TITLE= "Cooling Load Profile";
OPTION_TILE= "Options";
FAHRENHEIT_SYSTEM= 'Fahrenheit System';
CHANGE_FORM=false;
GENERAL_FORM_STATUS=false;
COOLING_FORM_STATUS=false;
NO_CUSTOM_FIELD_GENERAL=0;
NO_CUSTOM_FIELD_CHP=0;
NO_CUSTOM_FIELD=0;
NO_CUSTOM_FIELD_MAINTENENCE=0;
projectData={};
    LOCALE="{{(App::getLocale())}}"
    </script>
    </head>
    <body>
    
    @include('header')
    <div class="content">
    <div class="title m-b-md">
    
    <div class='row justify-content-center'>
    <div class='col-sm-8 mt-4 mb-4'>
    <form onsubmit="return submitForm(event)">
    <fieldset>
    <legend>Calculate</legend>
        <div class="form-group">
            <label for="Drive_temperature">Drive temperature</label>
            <input type="text" class="form-control" id="Drive_temperature" required name="drive_temperature" aria-describedby="textHelp" placeholder="Tn_HtIn">
        </div>
        <div class="form-group">
            <label for="cold_water">Cold water inlet temperature</label>
            <input type="text" class="form-control" id="cold_water" name="cold_water" required aria-describedby="textHelp" placeholder="Tn_LtIn">
        </div>
        <div class="form-group">
            <label for="Outdoor_temperature">Re-cooling Temperature</label>
            <input type="text" class="form-control" id="Outdoor_temperature" name="outdoor_temperature" required aria-describedby="textHelp" placeholder="Tn_MtIn">
        </div>
        <div class="form-group">
            <label for="Outdoor_temperature">Adsorption Chiller</label>
            <select class="form-control" id="adsorption_chiller" name="adsorption_chiller"  >
            <option value = "0">Select Adsorption Chiller</option>
            <option value = "eCoo10">eCoo10</option>
            <option value = "eCoo10">eCoo20</option>
            <option value = "eCoo10">eCoo30</option>
            <option value = "eCoo10">eCoo10X</option>
            <option value = "eCoo10">eCoo20X</option>
            <option value = "eCoo10">eCoo30X</option>
            <option value = "eCoo10">eCoo40X</option>
            </select>
           <!--  <input type="text" class="form-control" id="adsorption_chiller" name="adsorption_chiller" required aria-describedby="textHelp" placeholder=""> -->
        </div>
        <div class="form-group">
            <label for="Outdoor_temperature">Mod Type</label>
            <select class="form-control" id="adsorption_chiller" name="adsorption_chiller"  >
            
            <option value = "sika">sika</option>
            
            </select>
           <!--  <input type="text" class="form-control" id="adsorption_chiller" name="adsorption_chiller" required aria-describedby="textHelp" placeholder=""> -->
        </div>
    
    </fieldset>
    <div id="res" class="mb-2"></div>
    <button type="submit" class="btn btn-primary hide"  disabled>Create System</button>
    <button type="submit" class="btn btn-primary">Calculate</button>
    </fieldset>
    </form>
    </div>
    
    </div>
    
    </div>
    @include('footer')
    
    </div>
    
    
    
    </body>
    
    
    </html>
    
    
    <script>
        function submitForm(event){
            event.preventDefault();

            var data = $(event.target).serialize();
          //  console.log(data);


            axios.post('{{ url('calculate-data')}}', data)
            .then(function (response) {
                console.log('a: '+ response.data.a);
                console.log('b: '+ response.data.b);
                console.log('Qth_LtAd: '+ response.data.Qth_LtAd);

                // console.log('Qth_LtAd: '+ response.data.Qth_LtAd);
                // console.log('Qth_LtAd: '+ response.data.Qth_LtAd);
                // console.log('Qth_LtAd: '+ response.data.Qth_LtAd);
                $('#res').html('Calculation for Cooling Capacity are below:  <br/>  a:  ' + response.data.a +'<br/> b:  '+ response.data.b +'<br/>Cooling capacity(Qth_LtAd):  '+ response.data.Qth_LtAd+'KW <br/><br/>Calculation for Thermal COP are below:  <br/>  a:  ' + response.data.aa +'<br/> b:  '+ response.data.bb +'<br/>COP:  '+ response.data.COP +'<br/><br/> Heat capacity(Qth_HtAd): '+ response.data.Qth_HtAd+'KW' );

            })
            .catch(function (error) {
                console.log(error);
            });
        }
    </script>