@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($userType->title) ? $userType->title : 'User Type' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('user_types.user_type.destroy', $userType->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('user_types.user_type.index') }}" class="btn btn-primary" title="{{ trans('user_types.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('user_types.user_type.create') }}" class="btn btn-success" title="{{ trans('user_types.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('user_types.user_type.edit', $userType->id ) }}" class="btn btn-primary" title="{{ trans('user_types.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('user_types.delete') }}" onclick="return confirm(&quot;{{ trans('user_types.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('user_types.title') }}</dt>
            <dd>{{ $userType->title }}</dd>
            <dt>{{ trans('user_types.status') }}</dt>
            <dd>{{ ($userType->status) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection