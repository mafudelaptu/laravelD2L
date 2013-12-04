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
}
