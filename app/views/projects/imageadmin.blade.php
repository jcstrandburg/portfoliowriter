<div id='image-{{$image->id}}' class='moveable'>
	{{ Form::open( array('method'=>'delete', 'route'=>['image.destroy', $image->id], 'class'=>'ajaxDelete', 'data-id'=>$image->id, 'data-module'=>'image'))}} 
		<button type='submit'>Delete</button>
	{{ Form::close() }}
	{{link_to_route( 'image.edit', "Edit", $image->id, array('class'=>'enhanceHide'))}}
	<?php
	$params = array('class'=>'image', 'id'=>$image->id, 'direction'=>'up');
	echo View::make('sorting.form')->withParams($params);
	$params = array('class'=>'image', 'id'=>$image->id, 'direction'=>'down');
	echo View::make('sorting.form')->withParams($params);
	?>
	<img id='thumb-{{$image->id}}' src='{{$image->url}}' class='adminThumb'>	
	<span class='editable' data-operation='update-image' data-field='url' data-id='{{$image->id}}' data-postupdate='updateThumbnail'>{{$image->url}}</span>
	(<span class='editable' data-operation='update-image' data-field='alttext' data-id='{{$image->id}}'>{{$image->alttext}}</span>)
</div>