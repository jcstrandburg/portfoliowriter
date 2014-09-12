<div>
	{{ Form::label('name', 'Name: ')}}
	{{ Form::input('text', 'name', $project->name)}}
	{{ $errors->first('name')}}
</div>
<div>
	{{ Form::label('summary', 'Summary: ')}}
	{{ Form::textarea('summary', $project->summary)}}	
	{{ $errors->first('summary')}}		
</div>
<div>
	{{ Form::label('description', 'Description: ')}}
	{{ Form::textarea('description', $project->description)}}	
	{{ $errors->first('description')}}		
</div>