<h3>Create New Bullet</h3>
{{ Form::open(['route' => 'bullet.store', 'class'=>'ajax-form', 'data-module'=>'bullet']) }}
	@include( 'bullet.formbody')
	{{ Form::submit('Create Bullet')}}
{{ Form::close() }}
