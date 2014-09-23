<div>
	{{ Form::hidden('project_id', $tag->project_id)}}
</div>
<div>
	{{ Form::label('text', 'Text: ')}}
	{{ Form::text('text', $tag->text)}}	
	{{ $errors->first('text')}}
</div>