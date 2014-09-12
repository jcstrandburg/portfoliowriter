@extends( 'admin.layout')

@section('content')
	<h1>Edit Project</h1>
	{{ Form::open(['method' => 'put', 'route' => ['projects.update', $project->id]]) }}
		@include('projects.formbody')
		{{ Form::submit('Update Project')}}
	{{ Form::close() }}
@stop
