<?php

class Matchmode extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function gamequeues(){
		return $this->hasMany("Gamequeue", "matchmode_id");
	}
}
