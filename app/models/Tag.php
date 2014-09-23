<?php

class Tag extends Eloquent {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_tags';
	protected $fillable = ['project_id', 'text'];
	private static $rules = ['project_id'=>'required', 'text'=>'required'];
	
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
