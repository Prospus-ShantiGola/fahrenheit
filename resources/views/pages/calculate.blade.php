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
    <style>
    @media (max-width: 992px){
        .table thead th, .table thead th, .table thead th, .table td, .table th, .form-control label {
            font-size: small !important;
        }
    }
    .temperature_input {
        width:1rem;
        border:none;
        background:none;
        pointer-events : none;
    }
    </style>
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
                            <input type = "hidden" class= "calculation_type" name ="calculation_type" value = "calculation">
                            <div class="row calculate-form mt-3">
                                <div class="form-group col-sm-8">
                                    <label for="Drive_temperature_inlet">Drive temperature inlet </label>
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
                                <div class="form-group col-sm-3 ml-lg-3">
                                    <label for="drive_temperature_outlet float-left">Drive temperature outlet</label>
                                    <div class='clearfix'></div>
                                    <div class='d-inline float-left'>
                                        <input type='hidden' class='temperature_input global_input float-left mt-2 dtu_up' name='dtu_up' value='1' onchange='return temperatureChanged(event)' />
                                        <a href='javascript:void(0);' field='dtu_up' class='qtyplus disabled rounded px-2 my-2 mx-1 bg-light text-dark float-left' >
                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                        </a>
                                        <p class='px-1 py-2 drive_temperature_outlet_holder float-left'>
                                            51.1 <span>&#8451;
                                        </p>
                                        <a href='javascript:void(0);' field='dtu_down' class='qtyminus rounded  px-2 my-2 mx-1 bg-light text-dark float-left' >
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </a>
                                         <input type='text' class='temperature_input float-left mt-2' name='dtu_down' value='' onchange='return temperatureChanged(event)' />
                                    </div>
                                    <div class='clearfix'></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="cold_water_inlet">Chilled water temperature  </label>
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
                                <div class="form-group col-sm-3 ml-lg-3">
                                    <label for="cold_water_outlet float-left">Chilled water temperature outlet</label>
                                    <div class='clearfix'></div>
                                    <div class='d-inline float-left'>
                                        <input type='hidden' class='temperature_input global_input float-left mt-2 cwt_output_up' name='cwt_output_up' value='1' onchange='return temperatureChanged(event)' />
                                        <a href='javascript:void(0);' field='cwt_output_up' class='qtyplus disabled rounded px-2 my-2 mx-1 bg-light text-dark float-left' >
                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                        </a>
                                        <p class='px-1 py-2 cold_water_outlet_holder float-left'>
                                            10.2 <span>&#8451;
                                        </p>
                                        <a href='javascript:void(0);' field='cwt_output_down' class='qtyminus  rounded px-2 my-2 mx-1 bg-light text-dark float-left' >
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </a>
                                        <input type='text' class='temperature_input float-left mt-2' name='cwt_output_down' value='' onchange='return temperatureChanged(event)' />
                                    </div>
                                    <div class='clearfix'></div>
                                    {{-- <p class='pt-2 cold_water_outlet_holder'>10.2 <span>&#8451;</span></p> --}}
                                </div>
                            </div>
                            
                            {{-- <div class="row">
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
                                <div class="form-group col-sm-3 ml-lg-3">
                                    <label for="recooling_temperature_outlet">Re-cooling temperature outlet</label>
                                    <p class='pt-2 recooling_temperature_outlet_holder' style =" padding: 44px;">25.9 <span>&#8451;</span></p>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h4>AdKA</h4>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Type</label>
                                                <select class="form-control" id="AdKA_type" name="AdKA_type">
                                                    @if ($chiller_products->isNotEmpty())
                                                        @foreach ($chiller_products as $chiller_product)
                                                            <option value="{{$chiller_product->id}}">
                                                                {{ $chiller_product->product_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">n_AdKA</label>
                                                <input class="form-control" type="number" name='n_AdKA' value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">n_AsHT</label>
                                                <input class="form-control" type="number" name='n_AsHT' value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">n_AsLT</label>
                                                <input class="form-control" type="number" name='n_AsLT' value="1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Circuit Seperation</h4>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Type</label>
                                                <select class="form-control" id="Circuit_Seperation_type"
                                                    name="Circuit_Seperation_type">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">n_ST</label>
                                                <input class="form-control" type="number" name='n_ST' value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Oth_NomSt</label>
                                                <input class="form-control" type="number" name='Oth_NomSt' value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">dt_NomSt</label>
                                                <input class="form-control" type="number" name='dt_NomSt' value="1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Re-Cooler</h4>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Type</label>
                                                <select class="form-control" id="Re_Cooler_type" name="Re_Cooler_type">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">n_RK</label>
                                                <input class="form-control" type="number" name='n_RK' value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Oth_NomRk</label>
                                                <input class="form-control" type="number" name='Oth_NomRk' value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">dt_NomRk</label>
                                                <input class="form-control" type="number" name='dt_NomRk' value="1">
                                            </div>
                                        </div>
                                    </div>
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
            <span class = "drive_temp_connected" style="color:red;"></span><br/>
                <span class = "chilled_temp_connected" style="color:red;">   </span>
                <span class = "no_chiller_connected" style="color:red;">   </span>
            <div class="row mt-1">

                <div class="form-group col-sm-8">
                    <table class="table table-lightt result-table" >
                        <thead>
                            <tr>
                            <th scope="col">Adsorption Chiller</th>
                            <th scope="col">Cooling Capacity</th>
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
                    // $('.global_input').val('1');
                    // $('.calculation_type').val('calculation');
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
                    // $('.global_input').val('1');
                    // $('.calculation_type').val('calculation');
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
                    // $('.calculation_type').val('calculation');
                    //  $('.global_input').val('1');
                    submitForm();
                },
            });
        });

        jQuery(document).ready(function(){
        // This button will increment the value
        $('.qtyplus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            $('.calculation_type').val('recalculation');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Decreament
                var newValue = currentVal - 1;
        
                // if(newValue ==4)
                // {
                   
                //     $(this).addClass('disabled');
                // }
                // else if(newValue ==2)
                // {
                //     $(this).siblings('.qtyminus').removeClass('disabled');
                // }


                 var newValue = currentVal - 1;
            

                if(newValue ==1)
                {
                   
                    $(this).addClass('disabled');
                }
                else if(newValue ==3)
                {
                    $(this).siblings('.qtyminus').removeClass('disabled');
                }


                
                 $('input[name='+fieldName+']').val(newValue > 4 ? 4 : newValue).trigger('change');
                
            } else {
                  
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0).trigger('change');
            }
        });
        // This button will decrement the value till 0
        $(".qtyminus").click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).closest('.d-inline').find('.temperature_input').attr('name');
            //alert(fieldName)
            $('.calculation_type').val('recalculation');
            // Get its current value
 
            var currentVal =  parseInt($('input[name='+fieldName+']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one

                var newValue = currentVal +1;
            

                if(newValue ==4)
                {
                   
                    $(this).addClass('disabled');
                }
                else if(newValue ==2)
                {
                    $(this).siblings('.qtyplus').removeClass('disabled');
                }


                //  if(newValue ==4)
                // {
                   
                //     $(this).addClass('disabled');
                // }
                // else if(newValue ==2)
                // {
                //     $(this).siblings('.qtyminus').removeClass('disabled');
                // }

                $('input[name='+fieldName+']').val(newValue < 1 ? 1 : newValue).trigger('change');
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0).trigger('change');
            }
        });
    });

    function temperatureChanged(event){
        setTimeout(function(){
            submitForm()
        },1000);
    }

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
                        $('.drive_temp_connected').html('');
                            $('.chilled_temp_connected').html('');
                             $('.no_chiller_connected').html('');

            axios.post('{{ url('calculate-data') }}', data)
                .then(function (response) {
                    //alert(response.data.length)
                   // alert(response.data.no_record)
                        var n_asht =  $('.dtu_up').val();
                            var n_aslt =    $('.cwt_output_up').val();
                    if(response.status === 200 && response.data){
                    
                        var tableHtml = '';
                        // Set data to html table from Response
                        $.each(response.data, function(index,data){
                            if(data.no_record =='false')
                            {
                                 tableHtml += "<tr>\
                                <td scope='row'>No chiller found. </td>  </tr>";   
                               var no_data =  'n_AsHt = '+n_asht+' and n_AsLt = '+n_aslt+', This connection is impossible.';           
                            $('.no_chiller_connected').html(no_data);
                            }
                            else
                            {
                            tableHtml += "<tr>\
                                <td scope=\"row\">"+data.product_name+" </td>\
                                <td>"+data.cooling_capacity+"  </td>\
                                <td>"+data.driving_heat+"  </td>\
                            </tr>";
                          //  alert(data.driving_temp_outlet)
                            $('.drive_temperature_outlet_holder').html(data.driving_temp_outlet+" <span>&#8451;</span>");
                        $('.cold_water_outlet_holder').html(data.cold_water_temp_outlet + " <span>&#8451;</span>");
                        $('.recooling_temperature_outlet_holder').html(data.recooling_temp_outlet+" <span>&#8451;</span>");

                        if($('.calculation_type').val()=='recalculation')
                        {
                            //alert( Object.keys(response.data).length); cwt_output_up
                           
                            var number_count = Object.keys(response.data).length;

                            if(n_asht !='1' || n_aslt !='1' )
                            {
                            //     var drive_html   =   '('+number_count+' modules at drive circuit are serial connected)';
                            //     var chilled_html = '('+number_count+' modules at chilled water circuit are serial connected)';
                            // }
                            // else
                            // {
                                if(n_asht =='1')
                                {
                                    var module_input = 'module';
                                    var is_input = 'is';

                                }else
                                {
                                    var module_input = 'modules';
                                    var is_input = 'are';


                                    var drive_html = '('+n_asht +' '+ module_input + ' at drive circuit '+is_input+' connected in series.)';
                                     // var chilled_html = '('+n_aslt+' '+n_aslt_input +' at chilled water circuit '+n_aslt_is_input+' serial connected)';
                                }

                                if(n_aslt =='1')
                                {
                                    var n_aslt_input = 'module';
                                    var n_aslt_is_input = 'is';

                                }else
                                {
                                    var n_aslt_input = 'modules';
                                    var n_aslt_is_input = 'are';

                                    // var drive_html = '('+n_asht +' '+ module_input + ' at drive circuit '+is_input+' serial connected)';
                                     var chilled_html = '('+n_aslt+' '+n_aslt_input +' at chilled water circuit '+n_aslt_is_input+' connected in series.)';
                                }

                                // if(number_count == 1)
                                // {
                                // var drive_html = '('+n_asht +' '+ module_input +' at drive circuit '+is_input+' serial connected)';
                                // var chilled_html = '('+n_aslt+' '+module_input +' module at chilled water circuit '+is_input+' serial connected)';
                                // }
                                // else 
                                // {
                                    
                               // }

                            }
                            
                            $('.drive_temp_connected').html(drive_html);
                            $('.chilled_temp_connected').html(chilled_html);
                        }
                         

                         }



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

        function changeTemperature(event, type){
            var $targetEl = $(event.target).parent().find('.temperature_input');
            var oldValue = $targetEl.val();
            var newValue = oldValue || 4;

            console.log('target',$targetEl)
            console.log('oldValue',oldValue)
           

            if(type == 'inc'){
                if(newValue){
                    newValue = parseInt(oldValue) + 1;
                    $targetEl.val(newValue > 4 ? 4 : newValue);
                }
            }
            if(type == 'dec'){
                if(newValue){
                    newValue = parseInt(oldValue) - 1;
                    $targetEl.val(newValue < 1 ? 1 : newValue);
                }
            }

             console.log('type',type)
            console.log('newValue',newValue)
        }
        
    </script>
    </body>
    
    
    </html>
    
    
    