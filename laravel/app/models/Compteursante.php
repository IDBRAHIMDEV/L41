<?php

class Compteursante extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $connection = "assurnetsante";

	public $table = "compteur"; 
}
