<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Image extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_images';
	protected $fillable = ['project_id', 'url', 'alttext'];
	
	

	private static $rules = ['project_id'=>'required', 'url'=>'required', 'alttext'=>'required'];		
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
