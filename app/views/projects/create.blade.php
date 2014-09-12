@extends( 'admin.layout')

@section('content')
	<h1>Create New Project</h1>
	{{ Form::open(['route' => 'projects.store']) }}
		@include( 'projects.formbody')
		{{ Form::submit('Create Project')}}
	{{ Form::close() }}
@stop
