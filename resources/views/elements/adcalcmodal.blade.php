
<!-- Compression Chillers modal start -->

<!-- Compression Chillers modal end -->



<script>
        jQuery('[data-toggle="popover"]').popover();

        jQuery('body').on('click', function (e) {
            jQuery('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!jQuery(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    jQuery(this).popover('hide');
                }
            });
        });

        jQuery(document).ready(function(){


            jQuery(".help-toggle").click(function(){
                jQuery(".input-help-label").toggle();
            });
        });
        $(function () {




          // Add containers to the DOM
          var $calculator = $('<div/>', {id: 'calculator'}).appendTo('.calci-div');
          var $input = $('<input/>', {id: 'input'}).appendTo($calculator);
          var $buttons = $('<div/>', {id: 'buttons'}).appendTo($calculator);

          // Add buttons to the DOM
          jQuery.each('1234567890.=+-*/←C'.split(''), function () {
            var $button = $('<button/>', {text: this.toString(), click: function () {
              // Handle button clicks
              switch (jQuery(this).text()) {
                // '=' will fetch the current expression string, evaluate it,
                // and write the result back into the input/output field.
                // That's where the actual calculation happens.
                case '=': try {$input.val(eval($input.val()));} catch (e) {$input.val('ERROR');}
                // 'C' will clear the input/output field
                break; case 'C': return $input.val('');
                // 'CE' will delete the last character from the input/output field
                break; case '←': return $input.val($input.val().replace(/.$/, ''));
                // All other buttons will add a character to the input/output field
                break; default: $input.val($input.val() + $(this).text());
              }
            }}).appendTo($buttons);
          });
        });


   jQuery(document).ready(function(){
   jQuery('.dropdown-calci').click(function(event){
       event.stopPropagation();
        jQuery(".caculator-divv").slideToggle("fast");
   });
   jQuery(".caculator-divv").on("click", function (event) {
       event.stopPropagation();
   });
});

jQuery(document).on("click", function () {
   jQuery(".caculator-divv").hide();
});


        jQuery(document).ready(function(){
            jQuery(".new-row-addition").click(function(){
                jQuery(".add-new-row").toggle();
            });
        });
        //# sourceURL=adcalc-script.js
     </script>


