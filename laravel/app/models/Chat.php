<?php

class Chat extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $table = "chats";

	public function user() {
		return $this->belongsTo('User');
	}
}
