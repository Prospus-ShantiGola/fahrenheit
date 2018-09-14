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
                          <li><a href="#"><img src="images/icon_1.png" alt="" /></a></li>
                          <li><div data-toggle="modal" data-target="#message-popup-modal"><img src="images/icon_2.png" alt="" /></div></li>
                          <li><a href="#"><img src="images/icon_3.png" alt="" /></a></li>
                       </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                       <ul class="list-inline right-icon-list">
                          <li class=""><a href="#"><img src="images/icon_4.png" alt="" /></a></li>
                          <li><a href="#"><img src="images/icon_5.png" alt="" /></a></li>
                          <li><a href="#"><img src="images/icon_6.png" alt="" /></a></li>
                          <li><div data-toggle="modal" data-target="#contact-form-modal"><img src="images/icon_7.png" alt="" /></div></li>
                          <li><div data-toggle="modal" data-target="#login-modal"><img src="images/icon_8.png" alt="" /></a></li>
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



    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @include('elements.adcalcmodal')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.9.2/jarallax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.9.2/jarallax-element.min.js"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap.year.calendar.js') }}"></script>
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
