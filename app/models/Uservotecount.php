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

	public static function allowedToVote($votetype_id, $user_id){
		$data = Uservotecount::getVoteCounts($user_id)->first();
		switch ($votetype_id) {
			case 1://upvote
			if($data->upvotes > 0){
				return true;
			}
			else{
				return false;
			}
				# code...
			break;
			case 2: // downvote
			if($data->downvotes > 0){
				return true;
			}
			else{
				return false;
			}
			break;
			default:
			return false;
			break;
		}
	}

	public static function resetAllCounts(){
		
		$timestamp = strtotime(date("m.d.y"));
		$date = new DateTime;
		$date->setTimestamp($timestamp);

		$updateArray = array(
			"upvotes" => GlobalSetting::getWeeklyUpvoteCount(),
			"downvotes" => GlobalSetting::getWeeklyDownvoteCount(),
			"updated_at" => $date,
			);
		DB::table("uservotecounts")->update($updateArray);
	}

	public static function getLastUpdate(){
		$date = null;
		$data = DB::table("uservotecounts")->first();
		if(!empty($data)){
			$date = $data->updated_at;
		}
		return $date;
	}

	public static function updateCounts($user_id, $votetype_id){
		$data = Uservotecount::getVoteCounts($user_id);
		switch ($votetype_id) {
			case 1: // upvote
				$data->decrement("upvotes");
			break;
			case 2: // downvote
				$data->decrement("downvotes");
			break;
		}	
}
}
