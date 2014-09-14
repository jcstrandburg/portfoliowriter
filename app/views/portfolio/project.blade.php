<a class='anchor' name='project-{{$project->id}}'></a>
<div class='project lessDetails' id='proj-{{$project->id}}'>
	<h1>{{$project->name}}</h1>		
	<div class='overview-section'>
		<h2>Features:</h2>
		<ul>
		@foreach ($project->bullets as $bullet)
			<li>{{$bullet->label}}: {{$bullet->text}}</li>
		@endforeach
		</ul>
		<h2>Links</h2>
		@foreach ($project->links as $link)
			<a href='{{$link->url}}'>{{$link->text}}</a><br>
		@endforeach
		<div class='summary'>
			<h2>Summary</h2>
			{{$project->summary}}
		</div>
	</div>
	@if (count($project->images) > 0)
		<div class='image-section'>
			<h2>Images</h2>
			<img class='mainimg' id='mainimg-{{$project->id}}' src='{{$project->images[0]->url}}'>
			<div class='thumbnails'>
				@foreach ($project->images as $image)
					<a href='{{$image->url}}'><img class='thumb' data-src='{{$image->url}}' 
						@if ($preview)
							src='{{$image->url}}' 
						@else
							src='{{$image->thumbnail}}'
						@endif 
						data-projectid='{{$project->id}}' alt='{{$image->alttext}}'></a>
				@endforeach
			</div>
		</div>
	@endif
	<br class='clr'>
	<div class='details-section'>	
		<h2>Details</h2>
		{{$project->description}}
	</div>
	<div>
		<button data-projectid='{{$project->id}}' class='js-moreButton' type='button'>Show Me More</button>
		<a href='#project-{{$project->id}}' class='hashLink'><button data-projectid='{{$project->id}}' class='js-lessButton' type='button'>Show Me Less</button></a>
	</div>
</div>
