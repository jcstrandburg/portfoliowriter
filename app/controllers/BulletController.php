<?php

class BulletController extends \BaseController {

	protected $bullet;

	public function __construct(Bullet $bullet) {
		$this->bullet = $bullet;
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
		
		$this->bullet = new Bullet;
		$this->bullet->project_id = $project_id;
		return View::make('bullet.create')->withBullet( $this->bullet);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()	{
		$this->bullet->fill( Input::all());	
		
		if ( !$this->bullet->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->bullet->errors);
		}
		else {
			$this->bullet->save();		
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
		$bullet = Bullet::find($id);
		return View::make('bullet.edit')->withBullet( $bullet);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$this->bullet = Bullet::find($id);
		$this->bullet->fill( Input::all());

		if ( !$this->bullet->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->bullet->errors);
		}
		else {
			$this->bullet->update();
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
		Bullet::destroy($id);
		return Redirect::route("projects.index");
	}
}
