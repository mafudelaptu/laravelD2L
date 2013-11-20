<?php

class Userpoint extends Eloquent {
	protected $guarded = array();
	protected $table = "userpoints";
	public static $rules = array();


	public static function getPoints($user_id, $matchtype_id=0){
		$ret = 0;

		$points = DB::table("userpoints")->where("user_id", $user_id);
		$basePoints = Auth::user()->basePoints;
		switch($matchtype_id){
			case 0:
			case 1:
				$points = $points->where(function($query){
					$query->where("matchtype_id", 0)->orWhere("matchtype_id", 1);
				});
			break;
			default:
				$points = $points->where("matchtype_id", $matchtype_id);
		}
		$points = $points->sum("pointschange");
		$ret = $basePoints+$points;
		return $ret;
	}

}
