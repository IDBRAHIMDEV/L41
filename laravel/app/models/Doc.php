<?php

class Doc extends Eloquent {
	protected $guarded = array();

	public static $rules = array();


	public function documents() {
		return $this->hasOne('Document');
	}
}
