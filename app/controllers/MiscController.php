<?php

class MiscController extends \BaseController {

	protected $misc;

	public function __construct(Misc $misc) {
		$this->misc = $misc;
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
	/*public function create() {
		$project_id = Input::get('project_id');
		if ( $project_id == null) {
			return "No project id supplied!";
		}
		
		$this->link = new Link;
		$this->link->project_id = $project_id;
		return View::make('link.create')->withLink( $this->link);
	}*/


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	/*public function store()	{
		$this->link->fill( Input::all());	
		
		if ( !$this->link->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->link->errors);
		}
		else {
			$this->link->save();		
			return Redirect::route('projects.index');
		}
	}*/


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$misc = Misc::find($id);
		return View::make('misc.edit')->withMisc( $misc);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$this->misc = Misc::find($id);
		$this->misc->fill( Input::all());

		if ( !$this->misc->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->misc->errors);
		}
		else {
			$this->misc->update();
			return Redirect::route('projects.index');
		}		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function destroy($id) {
		Link::destroy($id);
		return Redirect::route("projects.index");
	}*/
}
