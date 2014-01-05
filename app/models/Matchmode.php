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
				$matchmode_id = GlobalSetting::getQuickJoinMatchmode();
				if($matchmode_id > 0){
					$mm = Matchmode::where("id", GlobalSetting::getQuickJoinMatchmode());
				}
				else{
					$mm = null;
				}
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
