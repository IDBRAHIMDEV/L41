<?php

class Reclamation extends Eloquent {
	
	protected $table = "reclamations";

	protected $guarded = array();

	public static $rules = array();

	public function motif() {
		return $this->belongsTo('Motif');
	}

	public function contrat(){
        return $this->belongsTo('Contrat');
	}

	public function traces(){
		return $this->hasMany('Action');
	}

	public function documents() {
		return $this->hasMany('Document');
	}
}
