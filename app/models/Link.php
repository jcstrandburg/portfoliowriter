<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Link extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_links';
	protected $fillable = ['project_id', 'text', 'url'];

	private static $rules = ['project_id'=>'required', 'text'=>'required', 'url'=>'required'];		
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
