<?php

class Enfant extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $table = "enfants";

	public function contrat() {
		return $this->belongTo('Contrat');
	}
}
