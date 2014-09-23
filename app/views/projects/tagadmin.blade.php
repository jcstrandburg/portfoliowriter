<div id='tag-{{$tag->id}}' class='moveable'>
	{{ Form::open( array('method'=>'delete', 'route'=>['tag.destroy', $tag->id], 'class'=>'ajaxDelete', 'data-id'=>$tag->id, 'data-module'=>'tag'))}} 
		<button type='submit'>Delete</button>
	{{ Form::close() }}
	{{link_to_route( 'tag.edit', "Edit", $tag->id, array('class'=>'enhanceHide'))}}	
	<?php
	$params = array('class'=>'tag', 'id'=>$tag->id, 'direction'=>'up');
	echo View::make('sorting.form')->withParams($params);
	$params = array('class'=>'tag', 'id'=>$tag->id, 'direction'=>'down');
	echo View::make('sorting.form')->withParams($params);
	?>
	<span class='editable' data-operation='update-tag' data-field='text' data-id='{{$tag->id}}' data-postupdate='updateThumbnail'>{{$tag->text}}</span>
</div>