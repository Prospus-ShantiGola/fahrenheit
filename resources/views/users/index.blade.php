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
                                    <a href="{{ route('users.users.create') }}" class="btn btn-primary" title="Create New Users">
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
                                                <th>User Name</th>
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





                                                        <div  class="action-button" role="group">
                                                            <a href="#"  title='{{ ($users->status == 1) ? "Disable" : "Enable"  }} User' data-user="{{ $users->id }}" data-status="{{ !$users->status }}"  data-toggle="modal" data-target="#disable-modal"  data-backdrop="false" id="disable_userbutton-{{ $users->id }}">

                                                                <i class="fas {{ ($users->status == 1) ? 'fa-user-times' : 'fa-user-check'  }} fa-lg">
                                                                    </i>
                                                            </a>
                                                            <a href="{{ route('users.users.edit', $users->id ) }}"  title="Edit User">

                                                                <i class="fas fa-user-edit fa-lg">
                                                                    </i>
                                                            </a>


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

                   @include('elements.modal')
@endsection
