<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return Redirect::to('index.html');
});

Route::get('login', function(){
	return View::make('admin.login');
});

Route::post('dologin', function(){
	$username = Input::get('name');
	$password = Input::get('password');
	
	if ( Auth::attempt( array('name'=>$username, 'password'=>$password))) {
		return Redirect::intended('edit');
	}
	else {
		return Redirect::back()->withInput();
	}	
});

Route::get('edit', function(){
	return Redirect::route('projects.index');
});

Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('/');
});

Route::get('preview', array('before'=>'auth', function(){
	$projects = Project::orderBy('sortorder')->get();
	$bio = Misc::where('name', '=', 'bio')->firstOrFail();
	return View::make('portfolio.index')->withProjects( $projects)->withPreview(true)->withBio( $bio);
}));

function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	try {
		if ( ($source_image = imagecreatefromjpeg($src)) === false) {
			return false;
		}	
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
		
		/* create the physical thumbnail image to its destination */
		return imagejpeg($virtual_image, $dest);
	}
	catch (Exception $e) {
		return false;
	}
}

Route::get('thumbtest', function(){
	$images = Image::all();
	$html = "";
	
	foreach ($images as $image) {	
		$source = $image->url;
		$dest = public_path()."/thumbs/".$image->id.".jpg";
		$html .= "Source: ".$image->url." --- Dest: $dest<br>";
		make_thumb( $source, $dest, 100);
	}	
	return $html;
});

Route::get('publish', function(){
	ob_start();

	$images = Image::all();
	foreach ($images as $image) {
		$source = $image->url;
		$dest = public_path()."/thumbs/{$image->id}.jpg";
		
		echo "Writing thumbnail $dest...";
		if (make_thumb( $source, $dest, 200)) {
			echo "success";
			$image->thumbnail = asset("thumbs/{$image->id}.jpg");
		}
		else {
			echo "failure";		
			$image->thumbnail = $source;
		}
		$image->save();
		echo "<br>";
	}

	$projects = Project::orderBy('sortorder')->get();
	$bio = Misc::where('name', '=', 'bio')->firstOrFail();
	$html = View::make('portfolio.index')->withProjects( $projects)->withPreview(false)->withBio($bio);
	$path = public_path().'/index.html';
	file_put_contents( $path, $html);
	
	echo "The static html portfolio page has been written {$path}. View it ".link_to('index.html', 'here').".";
	return ob_get_clean();
});

Route::any('api', ['as'=>'api', 'uses'=>'ApiController@api']);

Route::post('move', function() {
	$table = ucwords(Input::get('class'));
	$id = Input::get('id');
	$direction = Input::get('direction');
	
	if ($direction == 'up') {
		$gator = '<';
		$order = 'DESC';
	}
	else {
		$gator = '>';
		$order = 'ASC';
	}
	
	$object = $table::find($id);
	if ( $table == 'Project') {
		$object2 = $table::where('sortorder', $gator, $object->sortorder)->orderBy('sortorder', $order)->first();
	}
	else {
		$object2 = $table::where('sortorder', $gator, $object->sortorder)->where('project_id','=',$object->project_id)->orderBy('sortorder', $order)->first();
	}
	
	$output = "";
	$output .= "<h2>First Object</h2>";
	$output .= print_r($object->toArray(), true);
	$output .= "<h2>Second Object</h2>";
	if ( $object2 !== null) {
		$temp = $object->sortorder;
		$object->sortorder = $object2->sortorder;
		$object2->sortorder = $temp;

		$object->update();
		$object2->update();
		
		$output .= print_r($object2->toArray(), true);
	}
	else {
		if ( Request::ajax()) {
			return array('status'=>'warning', 'message'=>"Item can't be moved");			
		}
		$output .= "No object";
	}
	
	if (Request::ajax()) {
		return array('status'=>'success');
	}
	else {
		return Redirect::route('projects.index');
	}
});

Route::post('projects/set-visibility', function(){
	$id = Input::get('id');
	$project = Project::find($id);
	$visibility = Input::get('visibility');
	if ( $visibility == 'hidden') {
		$project->hidden = true;
	}
	else if ( $visibility == 'visible') {
		$project->hidden = false;
	}
	$project->update();
	
	return Redirect::route('projects.index');
});

Route::resource('projects', 'ProjectsController');
Route::resource('link', 'LinkController');
Route::resource('bullet', 'BulletController');
Route::resource('image', 'ImageController');
Route::resource('tag', 'TagController');
Route::resource('misc', 'MiscController');

