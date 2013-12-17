<?php

class Typemessage extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function messages(){
		return $this->hasMany('Message');
	}
}
