<?php

class Document extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function reclamation() {
		return $this->belongsTo('Reclamation');
	}

	public function doc() {
		return $this->belongsTo('Doc');
	}
}
