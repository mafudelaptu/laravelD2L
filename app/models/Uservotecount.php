<?php

class Uservotecount extends Eloquent {
	protected $guarded = array();
	protected $table = "uservotecounts";
	public static $rules = array(
		'user_id' => 'required',
		'upvotes' => 'required',
		'downvotes' => 'required'
	);

	public static function initUserVoteCounts($user_id){
		if(!Uservotecount::checkAlreadyHaveVoteCounts($user_id)){
			$insertArray = array();
			$insertArray['user_id'] = $user_id;
			$insertArray['upvotes'] = GlobalSetting::getWeeklyUpvoteCount();
			$insertArray['downvotes'] = GlobalSetting::getWeeklyDownvoteCount();
			$insertArray['created_at'] = new DateTime;
			$insertArray['updated_at'] = new DateTime;

			DB::table("uservotecounts")->insert($insertArray);
		}
	}

	public static function checkAlreadyHaveVoteCounts($user_id){
		$check = Uservotecount::getVoteCounts($user_id)->first();
		if(!empty($check)){
			return true;
		}
		else{
			return false;
		}
	}

	public static function getVoteCounts($user_id){
		return Uservotecount::where("user_id", $user_id);
	}
}
