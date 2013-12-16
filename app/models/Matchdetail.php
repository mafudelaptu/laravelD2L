<?php

class Matchdetail extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = "matchdetails";
	public $timestamps = false;

	public static function deleteMatchdetails($match_id){
		return DB::table("matchdetails")->where("match_id", $match_id)
		->delete();
	}

	public static function addDetailsToMatch($match_id, $matchedUsersArray){
		if(!Matchdetail::checkAlreadyExists($match_id)){
			if(count($matchedUsersArray)>0 && is_array($matchedUsersArray)){
				foreach ($matchedUsersArray as $key => $user) {
					unset($matchedUsersArray[$key]['created_at']);
					unset($matchedUsersArray[$key]['updated_at']);
					unset($matchedUsersArray[$key]['ready']);
				}

				Matchdetail::insert($matchedUsersArray);
			}
		}
	}

	public static function checkAlreadyExists($match_id){
		$count = DB::table("matchdetails")->where("match_id", $match_id)->count();
		if($count > 0){
			return true;
		}
		else{
			return false;
		}
	}

	public static function checkResultSubmitted($match_id, $user_id){
		$ret = false;
		$data = Matchdetail::where("match_id", $match_id)->where("user_id", $user_id)->first();
		if(!empty($data)){
			if($data->submitted > 0){
				$ret = true;
			}
		}
		return $ret;
	}
}
