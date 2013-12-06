<?php

class Matched_user extends Eloquent {
	protected $guarded = array();

	protected $table = 'matched_users';

	public static $rules = array();


	public static function alreadyMatched($user_id){
		$ret = false;
		$user = Matched_user::where("user_id", $user_id);
		if($user->count() > 0){
			$ret = true;
		}
		return $ret;
	}

	public static function getMatchedUserData($user_id){
		return Matched_user::where("user_id", $user_id);
	}

	public static function cleanMatchedUsers($match_id){
		return DB::table("matched_users")->where("match_id", $match_id)
						->delete();
	}

	public static function getAllMatchedUsersByMatchID($match_id){
		return Matched_user::where("match_id", $match_id);
	}
}
