<h3>Create New Tag</h3>
{{ Form::open(['route' => 'tag.store', 'class'=>'ajax-form', 'data-module'=>'tag']) }}
	@include( 'tag.formbody')
	{{ Form::submit('Create Tag')}}
{{ Form::close() }}
