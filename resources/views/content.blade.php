<section class="breadcrumbs" id="breadcrumb">

 </section>
    <!--banner section start-->
    <section class="adcalc-content">
        <div class="container">
           <div class="adcalc-inner-content">
              <!-- top icon -->
              <div class="icon-area">
                 <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                       <ul class="list-inline left-icon-list">

                          <li class ="disabled"><a href="{{ url('/') }}" class = "add-new-adcalc "><img src="public/images/icon_1.png" alt=""  /></a></li>
                          <li class ="disabled"><div data-toggle="modal" data-target=""><img src="public/images/icon_2.png" alt="" /></div></li>
                          <li class ="disabled"><a href="#"><img src="public/images/icon_3.png" alt="" /></a></li>

                       </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                       <ul class="list-inline right-icon-list">
                          <li class ="disabled"><a href="#"><img src="public/images/icon_4.png" alt="" /></a></li>
                          <li class ="disabled"><a href="#"><img src="public/images/icon_5.png" alt="" /></a></li>
                          <li class ="disabled"><a href="#"><img src="public/images/icon_6.png" alt="" /></a></li>
                          <li><div data-toggle="modal" data-target="#contact-form-modal" ><img src="public/images/icon_7.png" alt="" /></div></li>
                          <li><div data-toggle="modal" data-target="#loginModal"><img src="public/images/icon_8.png" alt="" /></a></li>
                       </ul>
                    </div>
                 </div>
              </div>
              <!-- top icon end -->
<div id="adcalc"></div>
           </div>
        </div>
        </div>
        </div>
     </section>
    <!-- banner section end -->



    <script src="{{ asset('public/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    @include('elements.adcalcmodal')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.9.2/jarallax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.9.2/jarallax-element.min.js"></script>
    <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.bootstrap.year.calendar.js') }}"></script>
    <script type="text/javascript">
        jQuery('.jarallax').jarallax({
            speed: 0.1
        });
    </script>
    <script>
        var owl = jQuery('#home-banner');
        owl.owlCarousel({
            margin: 10,
            loop: true,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>


  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"  aria-hidden="true" id="contact-form-modal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->

        <div class="modal-heading">
               <div class="left-head">Contact Fahrenheit</div>
               <div class="right-head">

                
                    <span class="close " 
 ><img src="public/images/cancle-icon.png" alt="" class ="close-contact-modals" data-dismiss="modal"   ></span>
                



               </div>
        </div>
      <!-- Modal body -->
      <div class="modal-body-content">
       <div class="table-responsive">
         <form name = "adad" class="fahrenheit-contact" method ="post">
                           <table class="table">
                             
                                 <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                    <tbody>
                                      <tr>
                                       <td class="input-label"> Name:</td>

                                      
                                       <td class="input-fields "><input type="text" name = "full_name" id = "full_name" placeholder="Enter your name"   minlength="1" maxlength="25"  class="required-field full_name" ></input>

                                         <span class="invalid-feedback  " role="alert">
                                            <strong></strong>
                                        </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="input-label"> Company:   </td>
                                     
                                       <td class="input-fields"><input type="text" name= "company_type" placeholder="Enter your company name" minlength="1" maxlength="25" class="company_type" ></input></td>
                                    </tr>
                                    <tr>
                                       <td class="input-label"> Tel. Number:</td>
                                     
                                       <td class="input-fields"><input type="text" name= "contact_number" id = "contact_number" placeholder="Enter your contact number" minlength="10" maxlength="16"   class="required-field contact_number"></input>
                                         <span class="invalid-feedback  " role="alert">
                                            <strong></strong>
                                        </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="input-label">Email:</td>
                                     
                                       <td class="input-fields"><input type="email" name= "emailaddress" id = "emailaddress" placeholder="Enter your email address"  minlength="1" maxlength="50"   class="required-field email_address"></input>
                                         <span class="invalid-feedback " role="alert">
                                            <strong>dfsdf</strong>
                                        </span> 

                                       </td>


                                     
                                    </tr>
                                   
                                    <tr>
                                       <td class="input-label text-area-label">Message:</td>

                                       <td class="input-fields textarea-place"><textarea name= "message" class = "message"></textarea></td>
                                    </tr>
                                    <tr>
                                     <td colspan="2" class="form-submitbtn"><button type="submit" class="btn submit-contact-form">Submit</button></td>
                                    </tr>
                                 </tbody>
                          
                        </table>
                         </form>
                        </div>
      </div>

    </div>
  </div>
</div>
      <!-- contact us modal end -->



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


            <!-- The Modal -->
<div class="modal" id="message-popup-modal">
  <div class="modal-dialog">
    <div class="modal-content">

   
  
        <div class="modal-heading">
          
               <div class="right-head">
                
                    <span class="close" data-dismiss="modal"><img src="images/cancle-icon.png" alt=""></span>
                
               </div>
            </div>

      <div class="modal-body-content">
       <p>Make sure you fill in all required fields in the following tiles:</p>
       <ul>
       <li>General Information</li>
        <li> Economic Data</li>
         <li> Cooling load profile</li>
       </ul>
      </div>

    </div>
  </div>
</div>







      <!-- message modal end -->    

  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="contact-us-modal">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body ">

               
            Your enquiry message for AdCalc has been sent to the Fahrenheit team. We will be in touch in the next 48 hours. 
    



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal">Ok</button>

        </div>
      </div>
    </div>

</div>    


  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="general-modal-confirm">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body ">
           <p> Are you sure want to cancel? </p>
          
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal" class= "modal-confirm" onclick ="jQuery('#general-information').modal('hide'); $('.general-information-form').removeClass('form-edited'); $('.general-information-form')[0].reset()">Yes</button>
          <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal" >No</button>

        </div>
      </div>
    </div>
  </div>  
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="compression-modal-confirm">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body ">
           <p> Are you sure want to cancel? </p>
          
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal" onclick ="jQuery('#compression-chiller').modal('hide'); $('#compression-chiller-form').removeClass('form-edited');  $('#compression-chiller-form')[0].reset()">Yes</button>
          <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal" >No</button>

       </div>


        </div>
      </div>
    </div>
  </div> 

  <div class="modal fade m" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="sure-modal">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body ">
           <p> Are you sure want to cancel? </p>
          
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal"  onclick ="jQuery('#contact-form-modal').modal('hide'); $('.fahrenheit-contact').removeClass('form-edited');  $('.fahrenheit-contact')[0].reset()" >Yes</button>
          <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal" >No</button>

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
                    url: "users/loginUser",
                    data: data,
                    cache: false,
                    success: function (data)
                    {
                        console.log('login request sent !');
                        console.log('status: ' +data.status);
                        console.log('message: ' +data.message);
                        if(data.status=="success"){
                            window.location.href="user_reports";
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


              jQuery(document).ready(function() {



               $('.fahrenheit-contact').on('submit',function(e){
                  // alert('dsa')

                   e.preventDefault();

                  //stopPropagation();

                var form_data = $('.fahrenheit-contact').serialize();

                var data = {

                    form_data:form_data


                };
                // Ajax Post
                $.ajax({
                       method: "post",
                       headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    url: "pages/submitContactForm",
                    data: data,
                    cache: false,
                    success: function (data)
                    {

                         if(typeof data.errors=="undefined"){
                    
                          $('#contact-form-modal').modal('hide');

                          $('#contact-us-modal').modal('show');    
                         //  $('#contact-us-modal .modal-body').html('show');
                         $('#contact-form-modal .fahrenheit-contact').removeClass('form-edited');
$(".fahrenheit-contact")[0].reset();
                       }
                       else
                       {
                       $(".fahrenheit-contact").find('.invalid-feedback').show().children('strong').html('');
                           jQuery.each(data.errors, function(key, value){
                            //alert('value'+value+'key'+key)
                                          
                                $(".fahrenheit-contact").find('#'+key).siblings('.invalid-feedback').show().children('strong').html(value);
                            });
                       }

                       
                    },
                    error: function (data){
                      //  alert('Fail to run Login..');
                    }
                });
               });


      $('.login-modal').on('click',function(e){
         if (loggedIn)
         {
           window.location = "user_reports"
         }

         else
         {
           $('#loginModal').modal('show');
         }
   })

$('.add-new-adcalc').on('click',function(e){


// if(('#adcalc .general-information-form, #compression-chiller-form').hasClass('form-edited'))
// {

// }
        
})



   $('#adcalc .general-information-form, #compression-chiller-form').on('keyup change paste', 'input, select, textarea', function(){
        // $('#business-flyin #business_profile_modal').removeClass('form-edited');
       // alert('dsd')
        $('#adcalc .general-information-form, #compression-chiller-form').addClass('form-edited');

        // alert( $('#business-flyin').data('backdrop'));

    });



   $('.fahrenheit-contact').on('keyup change paste', 'input, select, textarea', function(){


        $('.fahrenheit-contact').addClass('form-edited');

    });

//     $('body').on('click','.close-contact-modals',function (e) {
//      // e.preventDefault();
//      // e.stopPropagation();

//           var obj = this;
   
// alert('1')
//                if ( $('#contact-form-modal .fahrenheit-contact').hasClass('form-edited')) {
//                 alert('2')
               
//                 $('#sure-modal').modal('show');
//                  // $('#contact-form-modal .fahrenheit-contact').removeClass('form-edited');
                    
//                 }
//                 else
//                 {
//                  $('#contact-form-modal').modal('hide');
//                  $('#sure-modal').modal('hide');
//                  $('.fahrenheit-contact')[0].reset()
//                 }

              

//           })




 


 });


    $('#contact-form-modal').on('hide.bs.modal', function (event) {

   event.preventDefault();
   event.stopPropagation();

  // return false;
      
         if ( $('.fahrenheit-contact').hasClass('form-edited')) {
  
 
         $('#sure-modal').modal('show');
                    
                }
                else
                {
                   alert('444444')
                 $('#contact-form-modal').modal('hide');
                 $('.fahrenheit-contact')[0].reset()
                }
return false;


    });
           //# sourceURL=user.js
        </script>



