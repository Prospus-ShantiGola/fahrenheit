@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif


                        <div class="panel panel-default">

                            <div class="panel-heading clearfix">

                                <div class="pull-left">
                                    <h4 class="mt-5 mb-5"><img src="{{ asset('images/cropped-flake-32x32.png') }}" class="pageheader" alt="fahrenheit" />Users</h4>
                                </div>

                                <div class="btn-group btn-group-sm pull-right" role="group">
                                    <a href="{{ route('users.users.create') }}" class="btn btn-success" title="Create New Users">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true">Add New</span>
                                    </a>
                                </div>

                            </div>






                            @if(count($usersObjects) == 0)
                                <div class="panel-body text-center">
                                    <h4>No Users Available!</h4>
                                </div>
                            @else
                            <div class="panel-body panel-body-with-table">
                                <div class="table-responsive">

                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th>Full name</th>
                                                <th>Company</th>
                                                <th>Tel. No.</th>
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($usersObjects as $users)
                                            <tr>
                                                <td>{{ $users->name }}</td>
                                                <td>{{ $users->company }}</td>
                                                <td>{{ $users->phoneno }}</td>
                                                <td>{{ $users->email }}</td>

                                                <td>




                                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                                            <a href="{{ route('users.users.show', $users->id ) }}" class="btn btn-info " title="Show Users">
                                                                <span class="glyphicon glyphicon-open" aria-hidden="true">View</span>
                                                            </a>
                                                            <a href="{{ route('users.users.edit', $users->id ) }}" class="btn btn-primary" title="Edit Users">
                                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
                                                            </a>

                                                            <button type="button" class="btn btn-danger" title="Delete Users" data-user="{{ $users->id }}" data-status="{{ !$users->status }}"  data-toggle="modal" data-target="#disable-modal"  data-backdrop="false" id="disable_userbutton-{{ $users->id }}">
                                                                <span class="glyphicon glyphicon-trash" aria-hidden="true" id="status-button-{{ $users->id }}">{{ ($users->status == 1) ? "Disable" : "Enable"  }}</span>
                                                            </button>
                                                        </div>



                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="panel-footer">
                                {!! $usersObjects->render() !!}
                            </div>

                            @endif

                        </div>

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="disable-modal">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('images/fahrenheit_logo.png') }}" alt=""></h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                </div>
                                <div class="modal-body">
                                        Are you sure you want to <span id="user-status"></span> the user? Please Confirm by clicking Yes.
                                        <input type="text" class="form-control" id="recipient-id">
                                        <input type="text" class="form-control" id="recipient-status">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" id="modal-btn-si" onclick="confirmDisable();">Yes</button>
                                  <button type="button" class="btn btn-primary" id="modal-btn-no"  data-dismiss="modal">No</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <script>
                              function confirmDisable(){
                                var userId=  $("#recipient-id").val();
                                var status=  $("input#recipient-status").val();
                                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                                $.ajax({
                                    type: "POST",
                                    url: '/users/updatestatus',
                                    data: { _token: CSRF_TOKEN,id:userId,status:status },
                                    success: function( msg ) {
                                        var userStatus=(msg.enable=="Enable")? "1": "0";
                                        jQuery('#disable-modal').hide();
                                        if(msg.responsecode==1 && msg.enable=="Enable"){
                                            $("#status-button-"+userId).text("Enable");
                                            $("#disable_userbutton-"+userId).attr('data-status',userStatus)
                                        }
                                        else if (msg.responsecode==1 && msg.enable=="Disable"){
                                            $("#status-button-"+userId).text("Disable");
                                            $("#disable_userbutton-"+userId).attr('data-status',userStatus)
                                        }
                                        else {
                                            $("#error-modal").show();
                                        }

                                    }
                                });
                            }

                            jQuery(document).ready(function() {
                                jQuery('#disable-modal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget) // Button that triggered the modal
                                    var recipient = button.data('user') // Extract info from data-* attributes
                                    var recipientstatus = button.data('status') // Extract info from data-* attributes
                                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                    var modal = $(this)
                                    var statusText= (recipientstatus==1)? "Disable" : "Enable";
                                    modal.find('.modal-body span#user-status').text(statusText)
                                    modal.find('.modal-body input#recipient-id').val(recipient)
                                    modal.find('.modal-body input#recipient-status').val(recipientstatus)
                                  })

                            });


                          </script>
@endsection
