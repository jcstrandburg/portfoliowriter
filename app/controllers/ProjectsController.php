<?php

class ProjectsController extends BaseController {

	protected $project;

	public function __construct(Project $project) {
		$this->project = $project;
		$this->beforeFilter('auth');		
	}

	public function index()	{
		$projects = Project::orderBy('sortorder')->get();
		$miscs = Misc::all();
		$bio = Misc::where('name', '=', 'bio')->firstOrFail();
		$resumeURL = Misc::where('name', '=', 'resumeURL')->firstOrFail();
		$githubURL = Misc::where('name', '=', 'githubURL')->firstOrFail();		
		return View::make('projects.index')
			->with('projects', $projects)
			->with('bio', $bio)
			->with('resumeURL', $resumeURL)
			->with('githubURL', $githubURL);
	}
	
	public function create() {
		return View::make('projects.create')->with('project', new Project);
	}
	
	public function store() {
		$this->project->fill( Input::all());
		
		if ( !$this->project->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->project->errors);
		}
		else {
			$this->project->save();
			$this->project->sortorder = $this->project->id;
			$this->project->update();			
			return Redirect::route('projects.index');
		}
	}
	
	public function show($projectid) {
		return "here is one project in particular $projectid";
	}
	
	public function edit($id) {
		$project = Project::find($id);
		return View::make('projects.edit')->with('project', $project);
	}
	
	public function update($id) {
		$this->project = Project::find($id);
		$this->project->fill( Input::all());

		if ( !$this->project->valid()) {
			return Redirect::back()->withInput()->with('errors', $this->project->errors);
		}
		else {
			$this->project->update();
			return Redirect::route('projects.index');
		}		
	}
	
	public function destroy($id) {
		$project = Project::find($id);	
		if ( Input::has('confirmed')) {
			$project->bullets()->delete();
			$project->links()->delete();
			$project->images()->delete();
			$project->tags()->delete();
			$project->delete();
			return Redirect::route('projects.index');
		} else {
			return View::make('projects.delete')->withProject( $project);
		}
	}
	
	public function moveUp() {
	}
	
	public function moveDown() {
	}
}
