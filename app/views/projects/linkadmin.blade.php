<div id='link-{{$link->id}}'>
	{{ Form::open( array('method'=>'delete', 'route'=>['link.destroy', $link->id], 'class'=>'ajaxDelete', 'data-id'=>$link->id, 'data-module'=>'link'))}} 
	<button type='submit'>Delete</button>
	{{ Form::close() }}
	{{link_to_route( 'link.edit', "Edit", $link->id, array('class'=>'enhanceHide'))}}	
	<span class='editable' data-operation='update-link' data-field='url' data-id='{{$link->id}}'>{{$link->url}}</span> : 
	<span class='editable' data-operation='update-link' data-field='text' data-id='{{$link->id}}'>{{$link->text}}</span>
</div>