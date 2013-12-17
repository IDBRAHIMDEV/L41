<?php

class Compagnie extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $table = "compagnies";

	public function gammes() {
		return $this->hasMany('Gamme');
	}
}
