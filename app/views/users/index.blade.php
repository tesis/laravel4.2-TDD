@extends('layouts.master')

@section('content')
<div class="row">
<div class=" col-md-4 col-md-offset-4">
    @if (Auth::guest())
        <h3>Please <a href="{{ url() }}/login">log in</a>
			or <a href="{{ url() }}/register">create</a> an account.</h3>
    @else
        <h3>Welcom {{ Auth::user()->name }} </h3>
        <p>You are now in members area, you can <a href="{{ url() }}/logout">logout.</a></p>
    @endif
</div>
</div>
@stop
