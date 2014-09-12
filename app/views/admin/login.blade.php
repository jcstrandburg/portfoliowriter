@extends ('admin.layout')

@section('content')
	<div class='login'>
		<h2>Log In</h2>
		{{Form::open(array('url' => 'dologin', 'method' => 'post'))}}
		{{Form::label('name', 'User Name')}}
		{{Form::text('name')}}
		<br>
		{{Form::label('password', 'Password')}}
		{{Form::password('password')}}
		<br>
		{{Form::submit('Log In')}}
		{{Form::close()}}
	</div>
@stop