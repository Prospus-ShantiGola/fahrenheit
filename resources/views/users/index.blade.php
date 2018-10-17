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

                                
                                <div class="btn-group btn-group-sm pull-right" role="group">
                                    <a href="{{ route('users.users.create') }}" class="btn btn-primary" title="{{ __('users.add_new_user_button')}}">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true">{{ __('users.add_new_user_button')}}</span>
                                    </a>
                                </div>

                            </div>






                            @if(count($usersObjects) == 0)
                                <div class="panel-body text-center">
                                    <h4>{{ __('users.none_user_available')}}</h4>
                                </div>
                            @else
                            <div class="panel-body panel-body-with-table">
                                <div class="table-responsive">

                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th>{{ __('users.table_user_name')}} </th>
                                                <th>{{ __('users.table_company')}}</th>
                                                <th>{{ __('users.table_tel_number')}}</th>
                                                <th>{{ __('users.table_email')}}</th>
                                                <th>{{ __('users.table_user_actions')}}</th>
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
                                                            <a href="{{ route('users.users.edit', $users->id ) }}"  title="{{ __('users.table_edit_user')}}">

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
