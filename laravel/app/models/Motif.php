<?php

class Motif extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
    
    protected $table = "motifs";
    
    public function nature() {
		return $this->belongsTo('Nature');
	}

	public function produit() {
		return $this->belongsTo('Produit');
	}

	public function typereclamation() {
		return $this->belongsTo('Typereclamation');
	}

	public function reclamations() {
		return $this->hasMany('reclamation');
	}

	public function docs() {
		return $this->belongsToMany('Doc', 'docsmotifs', 'motif_id', 'doc_id');
	}

	
}
