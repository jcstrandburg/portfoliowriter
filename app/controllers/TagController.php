<?php

class TagController extends \BaseController {

	protected $tag;

	public function __construct(Tag $tag) {
		$this->tag = $tag;
		$this->beforeFilter('auth');
	}

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
		
		$this->tag = new tag;
		$this->tag->project_id = $project_id;
		return View::make('tag.create')->withTag( $this->tag);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()	{
		$this->tag->fill( Input::all());	
		
		if ( !$this->tag->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->tag->errors);
		}
		else {
			$this->tag->save();
			$this->tag->sortorder = $this->tag->id;
			$this->tag->update();			
			return Redirect::route('projects.index');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$tag = Tag::find($id);
		return View::make('tag.edit')->withTag( $tag);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$this->tag = Tag::find($id);
		$this->tag->fill( Input::all());

		if ( !$this->tag->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->tag->errors);
		}
		else {
			$this->tag->update();
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
		Tag::destroy($id);
		return Redirect::route("projects.index");
	}
}
