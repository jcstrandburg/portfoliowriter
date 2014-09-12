<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Bullet extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_bullets';
	protected $fillable = ['project_id', 'label', 'text'];
	
	

	private static $rules = ['project_id'=>'required', 'label'=>'required', 'text'=>'required'];		
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
