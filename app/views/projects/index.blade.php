@extends( 'admin.layout')

@section('content')
	<div class='container'>
		<div class='section'>
			<h1>Other Junk</h1>
			<button type='button' class='js-showhide enhanceShow'>Expand/Hide</button>
		</div>
		<div class='subsection'>
			<div class='section'>
				<div class='editable' data-operation='update-misc' data-field='{{$bio->name}}' data-id='{{$bio->id}}'>{{$bio->value}}</div>
			</div>
		</div>
	</div>

	@foreach ($projects as $project)
		<div class='container'>
			<div class='section'>
				<h1 class='editable heading' data-operation='update-project' data-field='name' data-id='{{$project->id}}'>{{$project->name}}</h1>
				<button type='button' class='js-showhide enhanceShow'>Expand/Hide</button>
				{{ Form::open( array('method'=>'delete', 'route'=>['projects.destroy', $project->id]))}} 
					<button type='submit'>Delete</button>
				{{ Form::close() }}<br>	
			</div>
			
			<div class='subsection'>
				<div class='section'>
					<h2>Project Data:</h2>
					<h3>Summary:</h3> <div class='editable' data-operation='update-project' data-field='summary' data-id='{{$project->id}}'>{{$project->summary}}</div><br>
					<h3>Description:</h3> <div class='editable' data-operation='update-project' data-field='description' data-id='{{$project->id}}'>{{$project->description}}</div><br>
					{{link_to_route( 'projects.edit', "Edit Project Data", $project->id, array('class'=>'enhanceHide'))}}
				</div>
				<div class='section'>
					<h2>Links:</h2>
					<div id='links-{{$project->id}}'>
						@foreach ($project->links as $link)
							@include( "projects.linkadmin")						
						@endforeach
					</div>
					<?php $link = new Link; $link->project_id = $project->id;?>
					<div class='enhanceShow'>@include('link.inline_create')</div>
					<div class='enhanceHide'>{{link_to_route( 'link.create', 'Add Link', ['project_id'=>$project->id])}}</div>
				</div>
				<div class='section'>
					<h2>Bullets:</h2>
					<div id='bullets-{{$project->id}}'>					
						@foreach ($project->bullets as $bullet)
							@include( "projects.bulletadmin")
						@endforeach
					</div>
					<?php $bullet = new Bullet; $bullet->project_id = $project->id;?>
					<div class='enhanceShow'>@include('bullet.inline_create')</div>
					<div class='enhanceHide'>{{link_to_route( 'bullet.create', 'Add Bullet', ['project_id'=>$project->id])}}</div>
				</div>
				<div class='section'>
					<h2>Images:</h2>
					<div id='images-{{$project->id}}'>
						@foreach ($project->images as $image)
							@include( "projects.imageadmin")							
						@endforeach
					</div>
					<?php $image = new Image; $image->project_id = $project->id;?>
					<div class='enhanceShow'>@include('image.inline_create')</div>					
					<div class='enhanceHide'>{{link_to_route( 'image.create', 'Add Image', ['project_id'=>$project->id])}}</div>
				</div>
			</div>
		</div>
	@endforeach
	
	<div class='container'>
		<div class='section'>
			{{ link_to_route( 'projects.create', 'Add Project')}}
			{{ link_to( '/preview', 'Preview', array('target'=>'_blank'))}}
		</div>
	</div>
@stop
