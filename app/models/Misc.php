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
}
