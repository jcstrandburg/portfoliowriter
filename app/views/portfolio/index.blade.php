<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1">	
	<style type='text/css'>
	@-ms-viewport { width: device-width; }
	@-o-viewport { width: device-width; }
	@viewport { width: device-width; }
	</style>
	<title>Justin Strandburg Portfolio</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>	
	{{HTML::style('css/base.css')}}
	{{HTML::style('css/nav.css')}}
	{{HTML::script('js/portfolio.js')}}
</head>
<body>

<div class='zoomContainer'><div class='zoomPositioner'></div><img class='zoomedImage'/></div>

<div class='header'>
	<span class='pagetitle'>Portfolio</span>
	<div class='menu'>
		<a href='javascript:void();' class='menuButton'>Menu</a>	
		<ul>	
			<li><a href='#bio'>About Me</a></li><li><a target='_blank' href='https://docs.google.com/document/d/1pq3KNPXM51o-LWv16tiEZlH71mAJFGqqcOLzSdK8T98/edit?usp=sharing'>Resume</a></li><li><a href='javascript:void();'>Projects</a>
				<ul>
					@foreach ($projects as $project)
						<li><a href='#project-{{$project->id}}'>{{$project->name}}</a></li>
					@endforeach
				</ul>
			</li>
		</ul>		
	</div>
</div>

<div class='portfolio'>
	@if (isset($preview) && $preview)
		<div class='publishSection'>
			This is a preview.<br>
			<a href='{{url("publish")}}'><button type='button'>Publish Portfolio</button></a>
		</div>
	@endif

	<a class='anchor' name='bio'></a>
	<div class='bio'>
		<h1>About Me:</h1>
		Here is some stuff about me.
	</div>
	@foreach ($projects as $project)
		@include('portfolio.project')
	@endforeach
	
	@if (isset($preview) && $preview)
		<div class='publishSection'>
			This is a preview.<br>
			<a href='{{url("publish")}}'><button type='button'>Publish Portfolio</button></a>
		</div>
	@endif	
	
</div>

</body>
</html>
