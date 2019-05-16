
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">{{ trans('user_types.title') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($userType)->title) }}" minlength="1" maxlength="55" required="true" placeholder="{{ trans('user_types.title__placeholder') }}">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">{{ trans('user_types.status') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="status_1">
            	<input id="status_1" class="" name="status" type="checkbox" value="1" {{ old('status', optional($userType)->status) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

