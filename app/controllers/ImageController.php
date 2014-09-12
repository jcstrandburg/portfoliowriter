<?php

class ImageController extends \BaseController {

	protected $image;

	public function __construct(Image $image) {
		$this->image = $image;
		$this->beforeFilter('auth');		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	/*public function index()
	{
	}*/


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$project_id = Input::get('project_id');
		if ( $project_id == null) {
			return "No project id supplied!";
		}
		
		$image = new Image;
		$image->project_id = $project_id;
		return View::make('image.create')->withImage( $image);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->image->fill( Input::all());	
		
		if ( !$this->image->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->image->errors);
		}
		else {
			$this->image->save();		
			return Redirect::route('projects.index');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function show($id)
	{
	}*/


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$image = Image::find($id);
		return View::make('image.edit')->withImage( $image);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->image = Image::find($id);
		$this->image->fill( Input::all());

		if ( !$this->image->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->image->errors);
		}
		else {
			$this->image->update();
			return Redirect::route('projects.index');
		}		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Image::destroy($id);
		return Redirect::route("projects.index");
	}
}
