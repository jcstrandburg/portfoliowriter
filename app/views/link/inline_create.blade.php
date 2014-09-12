<h3>Create New Link</h3>
{{ Form::open(['route' => 'link.store', 'class'=>'ajax-form', 'data-module'=>'link']) }}
	@include( 'link.formbody')
	{{ Form::submit('Create Link')}}
{{ Form::close() }}