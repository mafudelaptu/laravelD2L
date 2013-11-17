<?php

class Matchtype extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function getAllActiveMatchtypes(){
		return Matchtype::where("active", 1);
	}

}
