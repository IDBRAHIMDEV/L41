<?php

class Typereclamation extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function motifs() {
		return $this->hasMany('Motifreclamation');
	}
}
