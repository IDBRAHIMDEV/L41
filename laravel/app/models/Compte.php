<?php

class Compte extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function contrats(){
		return $this->hasMany('Contrat');
	}
}
