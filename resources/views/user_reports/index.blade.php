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
                <h4 class="mt-5 mb-5">User Reports</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('user_reports.user_report.create') }}" class="btn btn-success" title="Create New User Report">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true">Add New</span>
                </a>
            </div>

        </div>

        @if(count($userReports) == 0)
            <div class="panel-body text-center">
                <h4>No User Reports Available!</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>PDF</th>
                            <th>User</th>
                            <th>Company Name</th>


                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userReports as $userReport)
                        <tr>
                            <td>{{ $userReport->timestamp }}</td>
                            <td>{{ $userReport->title }}</td>
                            <td>{{ optional($userReport->user)->name }}</td>
                            <td>{{ optional($userReport->user)->company }}</td>


                            <td>

                                <form method="POST" action="{!! route('user_reports.user_report.destroy', $userReport->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('user_reports.user_report.show', $userReport->id ) }}" class="btn btn-info" title="Show User Report">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true">View</span>
                                        </a>
                                        <a href="{{ route('user_reports.user_report.edit', $userReport->id ) }}" class="btn btn-primary" title="Edit User Report">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete User Report" onclick="return confirm(&quot;Delete User Report?&quot;)">
                                            <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true">Delete</span>
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
            {!! $userReports->render() !!}
        </div>

        @endif

    </div>
@endsection
