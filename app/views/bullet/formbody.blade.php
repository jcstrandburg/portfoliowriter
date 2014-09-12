<div>
	{{ Form::hidden('project_id', $bullet->project_id)}}
</div>
<div>
	{{ Form::label('label', 'Label: ')}}
	{{ Form::text('label', $bullet->label)}}	
	{{ $errors->first('label')}}		
</div>
<div>
	{{ Form::label('text', 'Text: ')}}
	{{ Form::text('text', $bullet->text)}}	
	{{ $errors->first('text')}}		
</div>