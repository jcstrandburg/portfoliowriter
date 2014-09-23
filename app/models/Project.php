<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Project extends Eloquent {
	
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	protected $fillable = ['name', 'summary', 'description'];
	
	
	public function tags() {
		return $this->hasMany('Tag')->orderBy('sortorder');
	}
	
	public function links() {
		return $this->hasMany('Link')->orderBy('sortorder');
	}
	
	public function bullets() {
		return $this->hasMany('Bullet')->orderBy('sortorder');
	}
	
	public function images() {
		return $this->hasMany('Image')->orderBy('sortorder');
	}	
	
	private static $rules = ['name'=>'required', 'summary'=>'required', 'description'=>'required'];		
	public function valid() {
		$validator = Validator::make($this->attributes, static::$rules);
		if ( $validator->fails()) {
			$this->errors = $validator->messages();
			false;
		}
		else {
			return true;
		}
	}
}
