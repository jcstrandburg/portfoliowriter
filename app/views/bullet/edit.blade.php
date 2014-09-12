@extends( 'admin.layout')

@section('content')
	<h1>Edit Bullet</h1>
	{{ Form::open(['method' => 'put', 'route' => ['bullet.update', $bullet->id]]) }}
		@include('bullet.formbody')
		{{ Form::submit('Update Bullet')}}
	{{ Form::close() }}
@stop
