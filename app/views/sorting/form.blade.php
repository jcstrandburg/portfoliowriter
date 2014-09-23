{{ Form::open(array('method'=>'post', 'url'=>'move', 'class'=>'ajaxMove', 'data-direction'=>$params['direction'])) }}
	{{ Form::hidden('class', $params['class']); }}
	{{ Form::hidden('id', $params['id']); }}
	{{ Form::hidden('direction', $params['direction']); }}
	@if ($params['direction'] == 'up')
		{{ Form::submit('&#9650;')}}
	@else
		{{ Form::submit('&#9660;')}}	
	@endif
{{ Form::close() }}
