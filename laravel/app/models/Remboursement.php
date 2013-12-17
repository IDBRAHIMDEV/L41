<?php

class Remboursement extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $table = "remboursements";

	public function contrat(){
        return $this->belongsTo('Contrat');
	}
}
