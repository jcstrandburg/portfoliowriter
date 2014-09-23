<?php

class ApiController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');		
	}	

	protected function success($data, $message) {
		//header('Content-Type: application/json');
		return Response::json( ['status'=>'success', 'data'=>$data, 'message'=>$message]);
	}
	
	protected function error($data, $message) {
		//header('HTTP/1.1 500 Server Error');
		//header('Content-Type: application/json');
		return Response::json( ['status'=>'error', 'data'=>$data, 'message'=>$message]);	
	}

	public function api()	{
		$optype = Input::get('operation-type');
		switch ($optype) {
			case 'update-misc':
				return $this->updateMisc();
				break;
			case 'update-project':
				return $this->updateProject();
				break;
			case 'update-bullet':
				return $this->updateBullet();
				break;
			case 'update-link':
				return $this->updateLink();
				break;
			case 'update-image':
				return $this->updateImage();
				break;
			case 'update-tag':
				return $this->updateTag();
				break;
			case 'create-link':
				return $this->createLink();
				break;
			case 'create-bullet':
				return $this->createBullet();
				break;
			case 'create-image':
				return $this->createImage();
				break;
			case 'create-tag':
				return $this->createTag();
				break;
			case 'delete-link':
				return $this->deleteLink();
				break;
			case 'delete-bullet':
				return $this->deleteBullet();
				break;
			case 'delete-image':
				return $this->deleteImage();
				break;
			case 'delete-tag':
				return $this->deleteTag();
				break;
			default:
				return $this->error(null, "Unrecognized operation type: $optype");
				break;
		}
	}
	
	public function updateMisc() {
		$id = Input::get('id');
		$fieldname = Input::get('field');
		$value = Input::get('value');
		
		$misc = Misc::find( $id);
		$misc->value = $value;
		$misc->save();
		return $this->success(null, null);
	}
	
	public function updateProject() {
		$id = Input::get('id');
		$fieldname = Input::get('field');
		$value = Input::get('value');
		
		$project = Project::find($id);
		$project->$fieldname = $value;
		$project->save();
		return $this->success(null, null);
	}
	
	public function updateBullet() {
		$id = Input::get('id');
		$fieldname = Input::get('field');
		$value = Input::get('value');
		
		$bullet = Bullet::find($id);
		$bullet->$fieldname = $value;
		$bullet->save();
		return $this->success(null, null);
	}
	
	public function updateLink() {
		$id = Input::get('id');
		$fieldname = Input::get('field');
		$value = Input::get('value');
		
		$link = Link::find($id);
		$link->$fieldname = $value;
		$link->save();
		return $this->success(null, null);
	}	
	
	public function updateImage() {
		$id = Input::get('id');
		$fieldname = Input::get('field');
		$value = Input::get('value');
		
		$image = Image::find($id);
		$image->$fieldname = $value;
		$image->save();
		return $this->success(null, null);
	}
	
	public function updateTag() {
		$id = Input::get('id');
		$fieldname = Input::get('field');
		$value = Input::get('value');
		
		$tag = Tag::find($id);
		$tag->$fieldname = $value;
		$tag->save();
		return $this->success(null, null);
	}
	
	public function createImage() {
		$image = new Image();
		$image->fill( Input::get('formdata'));
		$image->save();
		$image->sortorder = $image->id;
		$image->update();
		$html = View::make('projects.imageadmin')->withImage($image)->render();
		return $this->success(['html'=>$html], 'It worked');
	}
	
	public function createBullet() {
		$bullet = new Bullet();
		$bullet->fill( Input::get('formdata'));
		$bullet->save();
		$bullet->sortorder = $bullet->id;
		$bullet->update();
		$html = View::make('projects.bulletadmin')->withBullet($bullet)->render();
		return $this->success(['html'=>$html], 'It worked');
	}
	
	public function createLink() {
		$link = new Link();
		$link->fill( Input::get('formdata'));
		$link->save();
		$link->sortorder = $link->id;
		$link->update();
		$html = View::make('projects.linkadmin')->withLink($link)->render();
		return $this->success(array('html'=>$html), 'It worked');
	}
	
	public function createTag() {
		$tag = new Tag();
		$tag->fill( Input::get('formdata'));
		$tag->save();
		$tag->sortorder = $tag->id;
		$tag->update();
		$html = View::make('projects.tagadmin')->withTag($tag)->render();
		return $this->success(array('html'=>$html), 'It worked');
	}
	
	public function deleteImage() {
		$id = Input::get('id');	
		Image::destroy($id);
		return $this->success(null, null);
	}
	
	public function deleteBullet() {
		$id = Input::get('id');	
		Bullet::destroy($id);
		return $this->success(null, null);	
	}
	
	public function deleteLink() {
		$id = Input::get('id');	
		Link::destroy($id);
		return $this->success(null, null);	
	}
	
	public function deleteTag() {
		$id = Input::get('id');	
		Tag::destroy($id);
		return $this->success(null, null);	
	}
}
