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
		<a href='javascript:void(0);' class='menuButton'>Menu</a>	
		<ul>	
			<li><a href='#bio'>About Me</a></li>
			@if ($resumeURL->value !== '')
				<li><a target='_blank' href='{{$resumeURL->value}}'>Resume</a></li>
			@endif
			@if ($githubURL->value !== '')
				<li><a target='_blank' href='{{$githubURL->value}}'>GitHub</a></li>
			@endif			
			<li><a href='javascript:void(0);'>Projects</a>
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
		{{$bio->value}}
	</div>
	@foreach ($projects as $project)
		@if (!$project->hidden)
			@include('portfolio.project')
		@endif
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
