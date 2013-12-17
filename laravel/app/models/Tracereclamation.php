<?php

class Tracereclamation extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function reclamation() {
		return $this->belongsTo('Reclamation');
	}

	public function action() {
		return $this->belongsTo('Action');
	}


}
