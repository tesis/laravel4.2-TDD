@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
<div class=" col-md-4 col-md-offset-4">
			<div class="panel panel-default">
            <div class="panel-heading"><h3> {{{ $title }}} </h3></div>
                <div class="panel-body">
                    @include('users.form')
                </div>
            </div>
        </div>
    </div>
</div>
@stop
