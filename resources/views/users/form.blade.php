
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label"> {{ __('users.table_user_name')}}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($users)->name) }}" minlength="1" maxlength="255" required="true" placeholder="{{ __('users.user_name__placeholder')}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
    <label for="company" class="col-md-2 control-label">{{ __('users.table_company')}}</label>
    <div class="col-md-10">
        <input class="form-control" name="company" type="text" id="company" value="{{ old('company', optional($users)->company) }}" minlength="1" maxlength="255" required="true" placeholder="{{ __('users.company__placeholder')}}">
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('phoneno') ? 'has-error' : '' }}">
    <label for="phoneno" class="col-md-2 control-label">{{ __('users.table_tel_number')}}</label>
    <div class="col-md-10">
        <input class="form-control" name="phoneno" type="mobile" id="phoneno" value="{{ old('phoneno', optional($users)->phoneno) }}" minlength="1" maxlength="255" required="true" placeholder="{{ __('users.tel_number__placeholder')}}">
        {!! $errors->first('phoneno', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">{{ __('users.table_email')}}</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($users)->email) }}" minlength="1" maxlength="255" required="true" placeholder="{{ __('users.email__placeholder')}}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} ">
    <label for="password" class="col-md-2 control-label">{{ __('users.table_password')}}</label>
    <div class="col-md-10">
        <input class="form-control" name="password" type="password" id="password" value="" minlength="1" maxlength="255"  placeholder="{{ __('users.password__placeholder')}}">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@can('isAdmin')
<div class="form-group {{ $errors->has('user_type_id') ? 'has-error' : '' }} {{ (Auth::id()==optional($users)->id) ? 'hide':''}} ">
        <label for="user_type_id" class="col-md-2 control-label">{{ __('users.table_user_type')}}</label>
        <div class="col-md-10">
                <select name="user_type_id" class="form-control">

                        @foreach ($userTypes as $userType)
                            <option value="{{ $userType->id }}" {{ old('user_type_id',  optional($users)->user_type_id) == $userType->id ? 'selected' : '' }}>{{ $userType->title }}</option>
                        @endforeach
                    </select>
            {!! $errors->first('user_type_id', '<p class="help-block">:message</p>') !!}
        </div>
</div>
@endcan





