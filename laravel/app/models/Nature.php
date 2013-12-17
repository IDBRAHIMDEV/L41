<?php

class Nature extends Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'natures';

	protected $guarded = array();

	public static $rules = array();

	public function motifs() {
		return $this->hasMany('Motif');
	}
}
