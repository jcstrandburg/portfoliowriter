<div id='image-{{$image->id}}'>
	<span class='editable' data-operation='update-image' data-field='url' data-id='{{$image->id}}'>{{$image->url}}</span>
	(<span class='editable' data-operation='update-image' data-field='alttext' data-id='{{$image->id}}'>{{$image->alttext}}</span>)
	{{link_to_route( 'image.edit', "Edit", $image->id, array('class'=>'enhanceHide'))}}
	{{ Form::open( array('method'=>'delete', 'route'=>['image.destroy', $image->id], 'class'=>'ajaxDelete', 'data-id'=>$image->id, 'data-module'=>'image'))}} 
		<button type='submit'>Delete</button>
	{{ Form::close() }}
</div>