{{ Form::open(['route'=>'users.store','role' => 'form', 'class' => 'blog-form form-horizontal']) }}

    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
        <fieldset class="col-md-12">
            {{ Form::label('name', 'Name', ['class'=>'control-label']) }}
            {{ Form::text('name',  Input::old('name', isset($user) ? $user->name : null) , ['class' => 'form-control', 'placeholder'=>'Name']) }}
            {{ $errors->first('name', '<span class="help-block">:message</span>') }}
        </fieldset>
    </div>

    <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
        <fieldset class="col-md-12">
            {{ Form::label('password', 'Password', ['class'=>'control-label']) }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder'=>'Password']) }}
            {{ $errors->first('password', '<span class="help-block">:message</span>') }}
        </fieldset>
    </div>

    <div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
        <fieldset class="col-md-12">
            {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'control-label']) }}
            {{ Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder'=>'Confirm Password']) }}
            {{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
        </fieldset>
    </div>

    <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
        <fieldset class="col-md-12">
            {{ Form::label('email', 'Email', ['class'=>'control-label']) }}
            {{ Form::text('email',  Input::old('email', isset($user) ? $user->email : null)  , ['class' => 'form-control', 'placeholder'=>'Email']) }}
            {{ $errors->first('email', '<span class="help-block">:message</span>') }}
        </fieldset>
    </div>

    <div class="form-group">
        <fieldset class="col-md-12">
            <button class="btn btn-default btn-cancel" data-dismiss="modal">{{ 'Cancel' }}</button>
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        </fieldset>
    </div>

{{ Form::close() }}
