<?php

class Misc extends Eloquent {
	
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'misc';
	protected $fillable = ['name', 'value'];
	
	private static $rules = ['id'=>'required', 'name'=>'required', 'value'=>'required'];		
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
