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
    <div class="container">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Users</h4>
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
                            <th>Tel</th>
                            <th>Email</th>


                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($usersObjects as $users)
                        <tr>
                            <td>{{ $users->name }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $users->email }}</td>

                            <td>

                                <form method="POST" action="{!! route('users.users.destroy', $users->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('users.users.show', $users->id ) }}" class="btn btn-info" title="Show Users">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true">View</span>
                                        </a>
                                        <a href="{{ route('users.users.edit', $users->id ) }}" class="btn btn-primary" title="Edit Users">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Users" onclick="return confirm(&quot;Delete Users?&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true">Delete</span>
                                        </button>
                                    </div>

                                </form>

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
    </div>
@endsection
