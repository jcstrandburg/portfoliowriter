@extends( 'admin.layout')

@section('content')
	<h1>Edit misc data field</h1>
	{{ Form::open(['method' => 'put', 'route' => ['misc.update', $misc->id]]) }}
		{{ Form::label('value', $misc->name); }}<br>
		{{ Form::textarea('value', $misc->value); }}<br>
		{{ Form::submit('Update Link')}}
	{{ Form::close() }}
@stop
