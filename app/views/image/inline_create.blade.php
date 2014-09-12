<h3>Create New Image</h3>
{{ Form::open(['route' => 'image.store', 'class'=>'ajax-form', 'data-module'=>'image']) }}
	@include( 'image.formbody')
	{{ Form::submit('Create Image')}}
{{ Form::close() }}

