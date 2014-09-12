@extends( 'admin.layout')

@section('content')
	<h1>Create New Image</h1>
	{{ Form::open(['route' => 'image.store']) }}
		@include( 'image.formbody')
		{{ Form::submit('Create Image')}}
	{{ Form::close() }}
@stop
