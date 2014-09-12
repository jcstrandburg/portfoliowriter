@extends( 'layout')

@section('content')
	@foreach ($users as $user)
	{{ link_to("user/{$user->name}", $user->name)}}<br>
	@endforeach
@stop
