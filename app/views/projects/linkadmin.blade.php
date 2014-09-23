<div id='link-{{$link->id}}' class='moveable'>
	{{ Form::open( array('method'=>'delete', 'route'=>['link.destroy', $link->id], 'class'=>'ajaxDelete', 'data-id'=>$link->id, 'data-module'=>'link'))}} 
	<button type='submit'>Delete</button>
	{{ Form::close() }}
	{{link_to_route( 'link.edit', "Edit", $link->id, array('class'=>'enhanceHide'))}}
	<?php
	$params = array('class'=>'link', 'id'=>$link->id, 'direction'=>'up');
	echo View::make('sorting.form')->withParams($params);
	$params = array('class'=>'link', 'id'=>$link->id, 'direction'=>'down');
	echo View::make('sorting.form')->withParams($params);
	?>
	<span class='editable' data-operation='update-link' data-field='url' data-id='{{$link->id}}'>{{$link->url}}</span> : 
	<span class='editable' data-operation='update-link' data-field='text' data-id='{{$link->id}}'>{{$link->text}}</span>
</div>