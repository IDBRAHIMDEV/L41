<?php

class Produit extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function contrats()
    {
        return $this->hasMany('Contrat');
    }

    public function motifs()
    {
        return $this->hasMany('Motifreclamation');
    }

}
