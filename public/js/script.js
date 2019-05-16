
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
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery(".help-toggle").click(function(){
        jQuery(".input-help-label").toggle();
    });

    $('#compression-chiller').on('hide.bs.modal', function (e) {
        $("#compression-chiller").find('form')[0].reset();
      })
});
let compressionChiller=[];
function saveComprissionChiller()
            {

                var token    =$("#compression-chiller-form").find("input[name=_token]").val();
                var refrigerant    = $("#compression-chiller-form").find("select[name=refrigerant]").val();
                var manufacturer    = $("#compression-chiller-form").find("select[name=manufacturer]").val();
                var compressor = $("#compression-chiller-form").find("select[name=compressor]").val();

                // Ajax Post
                $.ajax({
                    url: "/adcalc/storeCompressionChiller",
                    method: 'post',
                    data: {
                        _token:token,
                        refrigerant: refrigerant,
                        manufacturer: manufacturer,
                        compressor: compressor
                    },
                    success: function(data){
                            $("#compression-chiller-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $("#compression-chiller-form").find('#'+value).siblings('.invalid-feedback').show();
                            });
                            if(typeof data.errors=="undefined"){
                                compressionChiller.push($('#compression-chiller-form').serializeArray());
                                $("#compression-chiller").modal("hide");

                            }
                      }

                    });
                return false;
            }
