@extends( 'admin.layout')

@section('content')
	<h1>Create New Link</h1>
	{{ Form::open(['route' => 'link.store']) }}
		@include( 'link.formbody')
		{{ Form::submit('Create Link')}}
	{{ Form::close() }}
@stop
