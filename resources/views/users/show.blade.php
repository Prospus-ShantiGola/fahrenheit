@extends('layouts.app')

@section('content')
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($users->name) ? $users->name : 'Users' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('users.users.destroy', $users->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('users.users.index') }}" class="btn btn-primary" title="Show All Users">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true">Back</span>
                    </a>

                    <a href="{{ route('users.users.create') }}" class="btn btn-success" title="Create New Users">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true">Add New</span>
                    </a>

                    <a href="{{ route('users.users.edit', $users->id ) }}" class="btn btn-primary" title="Edit Users">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Users" onclick="return confirm(&quot;Delete Users??&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true">Delete</span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>name</dt>
            <dd>{{ $users->name }}</dd>
            <dt>Company</dt>
            <dd>{{ $users->company }}</dd>
            <dt>Tel. No.</dt>
            <dd>{{ $users->phoneno }}</dd>
            <dt>email</dt>
            <dd>{{ $users->email }}</dd>

        </dl>

    </div>
</div>
</div>
@endsection
