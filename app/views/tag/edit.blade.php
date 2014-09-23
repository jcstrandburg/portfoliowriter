@extends( 'admin.layout')

@section('content')
	<h1>Edit Tag</h1>
	{{ Form::open(['method' => 'put', 'route' => ['tag.update', $tag->id]]) }}
		@include('tag.formbody')
		{{ Form::submit('Update Tag')}}
	{{ Form::close() }}
@stop
