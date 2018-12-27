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
    {{-- <link rel="stylesheet" href="{{ url('node_modules/ion-rangeslider/css/ion.rangeSlider.min.css') }}"/> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    <script>
    window.app = {
        url : '{{ config("app.url") }}',
    };
   </script>
     <script>
        <?php if($user = Auth::user()) { ?>
        LOGGED_IN_ROLE= "<?php echo (Auth::user()->user_type_id ==3) ? 'expert':'user' ;?>";
        <?php } else { ?>
        LOGGED_IN_ROLE= "user";
        <?php } if($_SERVER['HTTP_HOST']=="localhost"){ ?>
        LOGGED_IN_ROLE = "expert";
        <?php } ?>
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
    <form id='calculation-form'>
    <fieldset>
    <legend>Calculate</legend>
        <div class="form-group">
            <label for="Drive_temperature">Drive temperature (Tn_HtIn)</label>
            <input 
                type="number" 
                class="form-control" 
                id="Drive_temperature" 
                required 
                name="drive_temperature" 
                aria-describedby="textHelp" 
                placeholder="Tn_HtIn"
            />
        </div>
        <div class="form-group">
            <label for="cold_water">Cold water inlet temperature (Tn_LtIn)</label>
            <input  
                type="number" 
                class="form-control" 
                id="cold_water" 
                name="cold_water" 
                required 
                aria-describedby="textHelp" 
                placeholder="Tn_LtIn"
            />
        </div>
        <div class="form-group">
            <label for="Outdoor_temperature">Re-cooling temperature (Tn_MtIn)</label>
            <input  
                type="number" 
                class="form-control" 
                id="Outdoor_temperature" 
                name="outdoor_temperature" 
                required 
                aria-describedby="textHelp" 
                placeholder="Tn_MtIn"
            />
        </div>
        <div class="form-group">
            <label for="Outdoor_temperature">Adsorption Chiller</label>

            <select class="form-control" id="adsorption_chiller" name="adsorption_chiller" onchange='return submitForm()' required  >

                <option value = "sika">eCoo10</option>
                <option value = "sika">eCoo20</option>
                <option value = "sika">eCoo30</option>
                <option value = "sikax">eCoo10X</option>
                <option value = "sikax">eCoo20X</option>
                <option value = "sikax">eCoo30X</option>
                <option value = "sikax">eCoo40X</option>
            </select>
        </div>
  
    
    </fieldset>
    <div id="res" class="mb-2"></div>
    <button type="submit" class="btn btn-primary hide"  disabled>Create System</button>
    <button type="submit" class="btn btn-primary hide">Calculate</button>
    </fieldset>
    </form>
    </div>
    
    </div>
    
    </div>
    @include('footer')
    
    </div>
    


    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/script.js') }}"></script>
    <script src="{{ asset('public/js/jquery.scrollbar.js') }}"></script>
    <script src="{{ asset('public/js/Sortable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        
        $(function() {
            $('#Drive_temperature').ionRangeSlider({
                min: 55,
                max: 90,
                from: 55,
                skin: "round",
                //step: 0.1,
                onFinish: function (data) {
                    submitForm();
                },
            });

            $('#cold_water').ionRangeSlider({
                min: 12,
                max: 20,
                from: 12,
                skin: "round",
                //step: 0.1,
                onFinish: function (data) {
                    submitForm();
                },
            });

            $('#Outdoor_temperature').ionRangeSlider({
                min: 23,
                max: 35,
                from: 22,
                skin: "round",
                //step :0.1,
                onFinish: function (data) {
                    submitForm();
                },
            });
        });

        function handleForm(){
            setTimeout(function(){
                submitForm()
            },1000);
        }

        function submitForm(){
            //event.preventDefault();


         
            var form = $('#calculation-form');


            var data = form.serialize();
           // console.log(`Form Submited`,data);
           var chiller_type=$('#adsorption_chiller option:selected').text();
             console.log(chiller_type);
             data = data+'&chiller_type='+chiller_type;



            axios.post('{{ url('calculate-data') }}', data)
                .then(function (response) {
                    console.log('a: '+ response.data.a);
                    console.log('b: '+ response.data.b);
                    console.log('Qth_LtAd: '+ response.data.Qth_LtAd);

                    // console.log('Qth_LtAd: '+ response.data.Qth_LtAd);
                    // console.log('Qth_LtAd: '+ response.data.Qth_LtAd);
                    // console.log('Qth_LtAd: '+ response.data.Qth_LtAd);
                    $('#res').html('Calculation for Cooling Capacity are below:  <br/>  a:  ' + response.data.a +'<br/> b:  '+ response.data.b +'<br/>Cooling capacity(Qth_LtAd):  '+ response.data.Qth_LtAd+'KW <br/><br/>Calculation for Thermal COP are below:  <br/>  a:  ' + response.data.aa +'<br/> b:  '+ response.data.bb +'<br/> c:  '+ response.data.c +'<br/> COP:  '+ response.data.COP +'<br/><br/> Heat capacity(Qth_HtAd): '+ response.data.Qth_HtAd+'KW' );

                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        
    </script>
    </body>
    
    
    </html>
    
    
    