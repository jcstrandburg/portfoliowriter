<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>

	<div class='outerWrapper'>
		<div class='section'>
		</div>
		@foreach( $projects as $project)
			<div class='section'>
			<h1>{{$project->name}}</h1>
			{{$project->summary}}
			</div>
		@endforeach
	</div>
</body>
</html>
