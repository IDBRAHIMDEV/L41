<?php

class Message extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $table = "messages";

	public function contrat() {
		return $this->belongsTo('Contrat');
	}

	public function typemessage() {
		return $this->belongsTo('Typemessage');
	}
}
