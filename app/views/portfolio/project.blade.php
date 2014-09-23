<a class='anchor' name='project-{{$project->id}}'></a>
<div class='project lessDetails' id='proj-{{$project->id}}'>
	<h1>{{$project->name}}</h1>
	<?php
	if (count($project->images) > 0) {
		$overview_class = 'overview-section';
	}
	else {
		$overview_class = '';
	}
	?>
	<div class='{{$overview_class}}'>
		@if (count($project->tags) > 0)
		<ul class='tags'>
			@foreach ($project->tags as $tag)
				<li>{{$tag->text}}</li>
			@endforeach
		</ul>			
		@endif
		@if (count($project->bullets) > 0)	
			<h2>Features:</h2>
			<ul>
				@foreach ($project->bullets as $bullet)
					@if (strlen( trim($bullet->label)) == 0)
						<li><strong>{{$bullet->text}}</strong></li>					
					@elseif (strlen( trim($bullet->text)) == 0)
						<li><strong>{{$bullet->label}}</strong></li>
					@else
						<li><strong>{{$bullet->label}}:</strong> {{$bullet->text}}</li>
					@endif
				@endforeach
			</ul>
		@endif
		@if (count($project->links) > 0)
			<h2>Links</h2>
			@foreach ($project->links as $link)
				<a href='{{$link->url}}'>{{$link->text}}</a><br>
			@endforeach
		@endif
		<div class='summary'>
			<h2>Summary</h2>
			{{$project->summary}}
		</div>
	</div>
	@if (count($project->images) > 0)
		<div class='image-section'>
			<!--<h2>Images</h2>-->
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
	@if (strlen(trim($project->description)) > 0)	
	<div class='details-section'>	
		<h2>Details</h2>
		{{$project->description}}
	</div>
		<div>
			<button data-projectid='{{$project->id}}' class='js-moreButton' type='button'>Show Me More</button>
			<a href='#project-{{$project->id}}' class='hashLink'><button data-projectid='{{$project->id}}' class='js-lessButton' type='button'>Show Me Less</button></a>
		</div>
	@endif
</div>
