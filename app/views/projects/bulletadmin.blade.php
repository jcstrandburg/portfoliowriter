<div id='bullet-{{$bullet->id}}'>
	{{ Form::open( array('method'=>'delete', 'route'=>['bullet.destroy', $bullet->id], 'class'=>'ajaxDelete', 'data-id'=>$bullet->id, 'data-module'=>'bullet'))}} 
		<button type='submit'>Delete</button>
	{{ Form::close() }}
	{{link_to_route( 'bullet.edit', "Edit", $bullet->id, array('class'=>'enhanceHide'))}}	
	<span class='editable' data-operation='update-bullet' data-field='label' data-id='{{$bullet->id}}'>{{$bullet->label}}</span>: 
	<span class='editable' data-operation='update-bullet' data-field='text' data-id='{{$bullet->id}}'>{{$bullet->text}}</span>
</div>