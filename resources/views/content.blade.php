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
                          <li><a href="#"><img src="public/images/icon_1.png" alt="" /></a></li>
                          <li><div data-toggle="modal" data-target="#message-popup-modal"><img src="public/images/icon_2.png" alt="" /></div></li>
                          <li><a href="#"><img src="public/images/icon_3.png" alt="" /></a></li>
                       </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                       <ul class="list-inline right-icon-list">
                          <li class=""><a href="#"><img src="public/images/icon_4.png" alt="" /></a></li>
                          <li><a href="#"><img src="public/images/icon_5.png" alt="" /></a></li>
                          <li><a href="#"><img src="public/images/icon_6.png" alt="" /></a></li>
                          <li><div data-toggle="modal" data-target="#contact-form-modal"><img src="public/images/icon_7.png" alt="" /></div></li>
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
<div class="modal" id="contact-form-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->

        <div class="modal-heading">
               <div class="left-head">Contact Fahrenheit</div>
               <div class="right-head">

                    <span class="close" data-dismiss="modal"><img src="public/images/cancle-icon.png" alt=""></span>

               </div>
            </div>
      <!-- Modal body -->
      <div class="modal-body-content">
       <div class="table-responsive">
                           <table class="table">
                              <form id = "fahrenheit-contact" class = "fahrenheit-contact" >
                                 <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <tbody><tr>
                                       <td class="input-label"> Name:</td>

                                       <td class="input-fields "><input type="text" name = "full_name" placeholder="Enter your name"   minlength="1" maxlength="25" required="true" class="required-field full_name"> </td>
                                    </tr>
                                    <tr>
                                       <td class="input-label"> Company:   </td>

                                       <td class="input-fields"><input type="text" name= "company_type" placeholder="Enter your company name" minlength="1" maxlength="25" class="company_type" ></td>
                                    </tr>
                                    <tr>
                                       <td class="input-label"> Tel. Number:</td>

                                       <td class="input-fields"><input type="number" name= "contact_number" placeholder="Enter your contact number" minlength="1" maxlength="50"  required="true" class="required-field contact_number"></td>
                                    </tr>
                                    <tr>
                                       <td class="input-label">Email:</td>

                                       <td class="input-fields"><input type="email" name= "email_address" placeholder="Enter your email address"  minlength="1" maxlength="50"  required="true" class="required-field email_address"></td>
                                    </tr>
                                    <tr>
                                       <td class="input-label text-area-label">Message:</td>

                                       <td class="input-fields textarea-place"><textarea name= "message" class = "message"></textarea></td>
                                    </tr>
                                    <tr>
                                     <td colspan="2" class="form-submitbtn"><button type="submit" class="btn submit-contact-form" >Submit</button></td>
                                    </tr>
                                 </tbody>
                           </form>
                        </table>
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

  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="contact-us-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body ">


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal">Ok</button>

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
                        console.log('login request sent !');
                        console.log('status: ' +data.status);
                        console.log('message: ' +data.message);
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
                    url: "/pages/submitContactForm",
                    data: data,
                    cache: false,
                    success: function (data)
                    {
                     $('#contact-form-modal').modal('hide');
                       if(data=='success')
                       {

                          $('#contact-us-modal').modal('show');
                           $('#contact-us-modal .modal-body').html('show');

                       }
                       else
                       {
                            $('#contact-us-modal').modal('show');
                              $('#contact-us-modal .modal-body').html('error');
                       }

                       $(".fahrenheit-contact")[0].reset();
                    },
                    error: function (data){
                      //  alert('Fail to run Login..');
                    }
                });
               });


      $('.login-modal').on('click',function(e){
         if (loggedIn)
         {
           window.location = "/user_reports"
         }

         else
         {
           $('#loginModal').modal('show');
         }
   })

 });
           //# sourceURL=user.js
        </script>



