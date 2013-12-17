<?php

class Reclamationsante extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $connection = "assurnetsante";

	public $table = "gr_reclamation";
}
