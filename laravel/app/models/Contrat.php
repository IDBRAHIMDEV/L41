<?php

class Contrat extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function produit()
    {
        return $this->belongsTo('Produit');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }


    public function reclamations()
    {
        return $this->hasMany('Reclamation');
    }

    public function remboursement()
    {
        return $this->hasOne('Remboursement');
    }

    public function messages()
    {
        return $this->hasMany('Message');
    }

    public function conjoint() {
    	return $this->hasOne('Conjoint');
    }

    public function enfants() {
    	return $this->hasMany('Enfant');
    }

    public function gamme() {
    	return $this->belongsTo('Gamme');
    }

  
}
