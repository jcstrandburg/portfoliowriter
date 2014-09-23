@extends( 'admin.layout')

@section('content')
	<h1>Create New Tag</h1>
	{{ Form::open(['route' => 'tag.store']) }}
		@include( 'tag.formbody')
		{{ Form::submit('Create Tag')}}
	{{ Form::close() }}
@stop
