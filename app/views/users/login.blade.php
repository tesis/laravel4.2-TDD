@extends('layouts.master')

@section('content')
<div class="row">
<div class=" col-md-4 col-md-offset-4">
    <h2><span class="glyphicon glyphicon-lock fa fa-lock"></span>  Login</h2>
    {{ Form::open(array('route' => 'login.store', 'class'=>'form-horizontal col-xs-8')) }}
        <div class="form-group">
            {{ Form::label('email', 'Email', ['class'=>'control-label']) }}
            {{ Form::email('email', '',['class' => 'form-control', 'placeholder'=>'Email']) }}
        </div>
        <div class="form-group">
            {{ Form::label('pasword', 'Password', ['class'=>'control-label']) }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder'=>'Password']) }}
        </div>
        <div class="form-group">
            {{ Form::checkbox('remeber_me'); }}
            {{ Form::label('remember_me', 'Remember Me', ['class'=>'control-label']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-block')) }}
        </div>

    {{ Form::close() }}
</div>
</div>
@stop
