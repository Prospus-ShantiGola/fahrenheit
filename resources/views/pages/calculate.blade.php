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
    <div class="container">
        <div class="content">
            <div class='row'>
                <div class='col-sm-12 mt-4 mb-4'>
                    <form id='calculation-form'>
                        <fieldset>
                            <legend>Calculate</legend>
                            <div class="row mt-3">
                                <div class="form-group col-sm-8">
                                    <label for="Drive_temperature_inlet">Drive temperature inlet</label>
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
                                <div class="form-group col-sm-3 ml-3">
                                    <label for="drive_temperature_outlet">Drive temperature outlet</label>
                                    <p class='pt-2 drive_temperature_outlet_holder'>51.1 <span>&#8451;</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="cold_water_inlet">Chilled water temperature inlet</label>
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
                                <div class="form-group col-sm-3 ml-3">
                                    <label for="cold_water_outlet">Chilled water temperature outlet</label>
                                    <p class='pt-2 cold_water_outlet_holder'>10.2 <span>&#8451;</span></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="recooling_temperature_inlet">Re-cooling temperature inlet</label>
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
                                <div class="form-group col-sm-3 ml-3">
                                    <label for="recooling_temperature_outlet">Re-cooling temperature outlet</label>
                                    <p class='pt-2 recooling_temperature_outlet_holder'>25.9 <span>&#8451;</span></p>
                                </div>
                            </div>
                            <div id="res" class="mb-2"></div>
                            <button type="submit" class="btn btn-primary hide"  disabled>Create System</button>
                            <button type="submit" class="btn btn-primary hide">Calculate</button>
                        </fieldset>

                        <!-- <select class="form-control" id="adsorption_chiller" name="adsorption_chiller" onchange='return submitForm()' required  >
                        <option value = "1">eCoo10</option>
                        <option value = "1">eCoo20</option>
                        <option value = "1">eCoo30</option>
                        <option value = "2">eCoo10X</option>
                        <option value = "2">eCoo20X</option>
                        <option value = "2">eCoo30X</option>
                        <option value = "2">eCoo40X</option> -->
                    </select> 
                    </form>
                </div>
            </div>
            <div class="row mt-1">
                <div class="form-group col-sm-8">
                    <table class="table table-lightt result-table" >
                        <thead>
                            <tr>
                            <th scope="col">Adsorption Chiller</th>
                            <th scope="col">Cooling Capicity</th>
                            <th scope="col">Driving Heat</th>
                            </tr>
                        </thead>
                        <tbody id='data-result'>
                        </tbody>
                    </table>
                    
                </div>  
            </div>
        </div>
    </div>
    @include('footer')
    


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

            $('#data-result').html('<div>Loading...</div>');
              $('.drive_temperature_outlet_holder').html('');
                        $('.cold_water_outlet_holder').html('');
                        $('.recooling_temperature_outlet_holder').html('');

            axios.post('{{ url('calculate-data') }}', data)
                .then(function (response) {

                    if(response.status === 200 && response.data){
                        var tableHtml = '';
                        // Set data to html table from Response
                        $.each(response.data, function(index,data){
                            tableHtml += "<tr>\
                                <td scope=\"row\">"+data.product_name+" </td>\
                                <td>"+data.cooling_capacity+"  </td>\
                                <td>"+data.driving_heat+"  </td>\
                            </tr>";
                            $('.drive_temperature_outlet_holder').html(data.driving_temp_outlet+" <span>&#8451;</span>");
                        $('.cold_water_outlet_holder').html(data.cold_water_temp_outlet + " <span>&#8451;</span>");
                        $('.recooling_temperature_outlet_holder').html(data.recooling_temp_outlet+" <span>&#8451;</span>");
                        });
                        

                        if(tableHtml.length){
                            $('#data-result').html(tableHtml);
                            //$('.result-table').show();
                        }

                        
                        //$('#res').html('Calculation for Cooling Capacity are below:  <br/>  a:  ' + response.data.a +'<br/> b:  '+ response.data.b +'<br/>Cooling capacity(Qth_LtAd):  '+ response.data.Qth_LtAd+'KW <br/><br/>Calculation for Thermal COP are below:  <br/>  a:  ' + response.data.aa +'<br/> b:  '+ response.data.bb +'<br/> c:  '+ response.data.c +'<br/> COP:  '+ response.data.COP +'<br/><br/> Heat capacity(Qth_HtAd): '+ response.data.Qth_HtAd+'KW <br/><br/> Recooling capacity(Qth_MtAd): '+ response.data.Qth_MtAd+'KW <br/><br/> HT Inlet temperature(THt_in): '+ response.data.Tht_in +'<br/> HT Outlet temperature(THt_out): '+ response.data.Tht_out +'<br/><br/> LT Inlet temperature(TLt_in): '+ response.data.Tlt_in +'<br/> LT Outlet temperature(TLt_out): '+ response.data.Tlt_out +'<br/><br/> MT Inlet temperature(TMt_in): '+ response.data.Tmt_in +'<br/> MT Outlet temperature(Tmt_out): '+ response.data.Tmt_out+'<br/><br/>   Volume flow (Vht): '+ response.data.vht +'<br/> Volume flow (Vlt): '+ response.data.vlt +'<br/> Volume flow (Vmt): '+ response.data.vmt);

                     //   $('#res').html('Calculation of  ADKA:  <br/>  Qth_Lt:  ' + response.data.Qth_Lt +'<br/> COPth:  '+ response.data.COPth +'<br/>Qth_Mt:  '+response.data.Qth_Mt+'<br/>  Qth_Ht:  ' + response.data.Qth_Ht +'<br/> Tn_LtOut:  '+ response.data.Tn_LtOut +'<br/> Tn_MtOut:  '+ response.data.Tn_MtOut +' <br/> Tn_Ht_Out:  '+ response.data.Tn_HtOut +'<br/> Vf_Ht: '+ response.data.Vf_Ht+'<br/> Vf_Mt: '+ response.data.Vf_Mt+'<br/> Vf_Lt: '+ response.data.Vf_Lt );
                    }


                })
                .catch(function (error) {
                    console.log(error);
                });
        }
        
    </script>
    </body>
    
    
    </html>
    
    
    