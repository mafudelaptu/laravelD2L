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

	public static function getAllActiveModes(){
		$modes = Matchmode::where("active", 1)->remember(60);
		return $modes;
	}

	public static function getMatchmodeData($matchmode_id){
		$modes = Matchmode::where("id", $matchmode_id)->remember(60);
		return $modes;
	}
}
