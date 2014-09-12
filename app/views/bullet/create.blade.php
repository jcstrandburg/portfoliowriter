@extends( 'admin.layout')

@section('content')
	<h1>Create New Bullet</h1>
	{{ Form::open(['route' => 'bullet.store']) }}
		@include( 'bullet.formbody')
		{{ Form::submit('Create Bullet')}}
	{{ Form::close() }}
@stop
