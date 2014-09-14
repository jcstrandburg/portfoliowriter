@extends( 'admin.layout')

@section('content')
	<div class='container'>
		<div class='section'>
			Are you sure you wish to delete this project: {{$project->name}}<br>
			{{ Form::open( array('method'=>'delete', 'route'=>['projects.destroy', $project->id]))}} 
				{{Form::hidden('confirmed', 'true')}}
				<button type='submit'>I'm Sure</button>		
			{{ Form::close() }}	
			{{link_to_route( 'projects.index', 'Never Mind')}}</div>
		</div>
	</div>
@stop
