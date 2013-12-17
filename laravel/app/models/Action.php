<?php

class Action extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public $table = "actions";
	
	public function trace() {
		return $this->belongsTo('Reclamation');
	}
}
