<div>
	{{ Form::hidden('project_id', $image->project_id)}}
</div>
<div>
	{{ Form::label('url', 'URL: ')}}
	{{ Form::text('url', $image->url)}}	
	{{ $errors->first('url')}}		
</div>
<div>
	{{ Form::label('alttext', 'Alt Text: ')}}
	{{ Form::text('alttext', $image->alttext)}}	
	{{ $errors->first('alttext')}}		
</div>