@extends( 'admin.layout')

@section('content')
	<h1>Edit Image</h1>
	{{ Form::open(['method' => 'put', 'route' => ['image.update', $image->id]]) }}
		@include('image.formbody')
		{{ Form::submit('Update Image')}}
	{{ Form::close() }}
@stop
