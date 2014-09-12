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
	
	
	public function links() {
		return $this->hasMany('Link');
	}
	
	public function bullets() {
		return $this->hasMany('Bullet');
	}
	
	public function images() {
		return $this->hasMany('Image');
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
