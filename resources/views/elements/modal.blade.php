<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="disable-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">
                Are you sure you want to <span id="user-status"></span> the user? Please confirm by clicking Yes.
                <input type="hidden" class="form-control" id="recipient-id">
                <input type="hidden" class="form-control" id="recipient-status">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="modal-btn-si" onclick="confirmDisable();">Yes</button>
          <button type="button" class="btn btn-primary" id="modal-btn-no"  data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="error-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('public/images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">
               There is some issue while submitting you request.

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal">Ok</button>

        </div>
      </div>
    </div>
</div>

                          <script>
                              function confirmDisable(){
                                var userId=  $("#recipient-id").val();
                                var status=  $("input#recipient-status").val();
                               // alert(status)
                                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                                $.ajax({
                                    type: "POST",
                                    url: '/users/updatestatus',
                                    data: { _token: CSRF_TOKEN,id:userId,status:status },
                                    success: function( msg ) {

                                        var userStatus=(msg.enable=="Enable")? "1": "";
                                       // alert('user _'+userStatus)
                                        jQuery('#disable-modal').modal('hide');
                                        if(msg.responsecode==1 && msg.enable=="Enable"){
                                            $("#status-button-"+userId).text("Enable");
                                            $("#disable_userbutton-"+userId).data('status',userStatus)
                                            $("#disable_userbutton-"+userId).find('.fa-lg').removeClass('fa-user-times').addClass('fa-user-check');
                                        }
                                        else if (msg.responsecode==1 && msg.enable=="Disable"){
                                            $("#status-button-"+userId).text("Disable");
                                            $("#disable_userbutton-"+userId).data('status',userStatus)
                                                 $("#disable_userbutton-"+userId).find('.fa-lg').removeClass('fa-user-check').addClass('fa-user-times');
                                        }
                                        else {
                                            $("#error-modal").modal('show');

                                        }

                                    }
                                });
                            }

                            jQuery(document).ready(function() {
                                jQuery('#disable-modal').on('show.bs.modal', function (event) {
                                  //  alert('enter')
                                    var button = $(event.relatedTarget) // Button that triggered the modal
                                    var recipient = button.data('user') // Extract info from data-* attributes
                                    var recipientstatus = button.data('status') // Extract info from data-* attributes
                                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                    //alert(recipient+ '________button'+recipientstatus)
                                    var modal = $(this)
                                    var statusText= (recipientstatus==1)? "disable" : "enable";
                                    modal.find('.modal-body span#user-status').text(statusText)
                                    modal.find('.modal-body input#recipient-id').val(recipient)
                                    modal.find('.modal-body input#recipient-status').val(recipientstatus)
                                  })

                            });


                          </script>
