<?php

class Matchmode extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function gamequeues(){
		return $this->hasMany("Gamequeue", "matchmode_id");
	}

	public static function getQuickJoinModes($matchtype_id){
		switch ($matchtype_id) {
			case 1: // single5vs5
			default:
				# code...
				$mm = Matchmode::where("id", 9);
				break;
		}
		return $mm;
	}

}
