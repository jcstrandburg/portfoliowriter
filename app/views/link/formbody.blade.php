<div>
	{{ Form::hidden('project_id', $link->project_id)}}
</div>
<div>
	{{ Form::label('url', 'URL: ')}}
	{{ Form::text('url', $link->url)}}	
	{{ $errors->first('url')}}		
</div>
<div>
	{{ Form::label('text', 'Text: ')}}
	{{ Form::text('text', $link->text)}}	
	{{ $errors->first('text')}}		
</div>