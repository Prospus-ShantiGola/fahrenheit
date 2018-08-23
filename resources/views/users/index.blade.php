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


                                                <th><div class="btn-group btn-group-sm pull-right" role="group">
                                                        <a href="{{ route('users.users.create') }}" class="btn btn-success" title="Create New Users">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true">Add New</span>
                                                        </a>
                                                    </div></th>
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

                                                            <button type="button" class="btn btn-danger" title="Delete Users"  data-toggle="modal" data-target="#disable-modal">
                                                                <span class="glyphicon glyphicon-trash" aria-hidden="true">Disable</span>
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
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('images/fahrenheit_logo.png') }}" alt=""></h4>
                                </div>
                                <div class="modal-body">
                                        Are you sure you want to Disable the user? Please Confirm by clicking Yes.
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" id="modal-btn-si">Yes</button>
                                  <button type="button" class="btn btn-primary" id="modal-btn-no"  data-dismiss="modal">No</button>
                                </div>
                              </div>
                            </div>
                          </div>
@endsection
