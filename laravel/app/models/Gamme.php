<?php

class Gamme extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $table = "gammes";
	

	public function compagnie() {
		return $this->belongsTo('Compagnie');
	}


	public function contrats() {
		return $this->hasMany('Contrat');
	}


}
