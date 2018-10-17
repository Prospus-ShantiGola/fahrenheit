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



        @if(count($userReports) == 0)
            <div class="panel-body text-center">
                <h4>{{ __('user_reports.none_report_available')}}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ __('user_reports.table_timestamp')}}</th>
                            <th>{{ __('user_reports.table_project')}}</th>
                            @can('isAdmin')
                            <th>{{ __('user_reports.table_user')}}</th>
                            <th>{{ __('user_reports.table_company_name')}}</th>
                            @endcan
                            <th>{{ __('user_reports.table_actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userReports as $userReport)
                        <tr>
                            <td>{{ $userReport->timestamp->format('m.d.y H:m') }}</td>
                            <td>{{ $userReport->title }}</td>
                            @can('isAdmin')
                            <td>{{ optional($userReport->user)->name }}</td>
                            <td>{{ optional($userReport->user)->company }}</td>
                            @endcan

                            <td>

                                <form method="POST" action="{!! route('user_reports.user_report.destroy', $userReport->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="action-button" role="group">
                                        <a href="#" class="disabled"  >
                                            <i class="fas fa-eye fa-lg disabled">
                                                </i>
                                        </a>
                                        <a href="#"  class="disabled"  >
                                            <i class="fas fa-file-pdf fa-lg disabled">
                                            </i>
                                        </a>
                                        <a href="#"   title="{{ __('user_reports.table_disable_user_report')}}" data-toggle="modal" data-backdrop="false" data-target="#delete-modal">
                                                <i class="fas fa-trash-alt fa-lg">
                                                    </i>
                                        </a>

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
    @if(count($userReports) != 0)
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="delete-modal">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('images/fahrenheit_logo.png') }}" alt=""></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                        {{ __('user_reports.delete_popup_msg')}}
                </div>
                <div class="modal-footer">
                        <form method="POST" action="{!! route('user_reports.user_report.destroy', $userReport->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                  <button type="submit" class="btn btn-default" title="Delete User Report">  {{ __('user_reports.delete_popup_yes')}}</button>
                </form>
                  <button type="button" class="btn btn-primary" id="modal-btn-no"  data-dismiss="modal">  {{ __('user_reports.delete_popup_no')}}</button>
                </div>
              </div>
            </div>
          </div>
          @endif
@endsection
