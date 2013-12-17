<?php

class Conjoint extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $table = "conjoints";

	public function contrat() {
		return $this->belongTo('Contrat');
	}
}
