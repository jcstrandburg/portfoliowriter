<?php

class LinkController extends \BaseController {

	protected $link;

	public function __construct(Link $link) {
		$this->link = $link;
		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	/*public function index() {
	}*/


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$project_id = Input::get('project_id');
		if ( $project_id == null) {
			return "No project id supplied!";
		}
		
		$this->link = new Link;
		$this->link->project_id = $project_id;
		return View::make('link.create')->withLink( $this->link);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()	{
		$this->link->fill( Input::all());
		
		if ( !$this->link->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->link->errors);
		}
		else {
			$this->link->save();
			$this->link->sortorder = $this->link->id;
			$this->link->update();
			return Redirect::route('projects.index');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function show($id) {
	}*/


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$link = Link::find($id);
		return View::make('link.edit')->withLink( $link);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$this->link = Link::find($id);
		$this->link->fill( Input::all());

		if ( !$this->link->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->link->errors);
		}
		else {
			$this->link->update();
			return Redirect::route('projects.index');
		}		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Link::destroy($id);
		return Redirect::route("projects.index");
	}
}
