@extends( 'admin.layout')

@section('content')
	<h1>Edit Link</h1>
	{{ Form::open(['method' => 'put', 'route' => ['link.update', $link->id]]) }}
		@include('link.formbody')
		{{ Form::submit('Update Link')}}
	{{ Form::close() }}
@stop
