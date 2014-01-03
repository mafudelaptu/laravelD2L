<?php

class Matchdetail extends Eloquent {
	protected $guarded = array();
	protected $winValue = 1;
	protected $loseValue = -1;
	public static $rules = array();

	protected $table = "matchdetails";
	protected $primaryKey = array("match_id", "user_id");
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

	public static function getMatchdetailData($match_id, $userData=false, $getPointChanges=false){
		if($userData == true){
			$ret = Matchdetail::where("matchdetails.match_id", $match_id)
			->leftJoin('users', 'users.id', '=', 'matchdetails.user_id')
			;
		}
		else{
			$ret = Matchdetail::where("matchdetails.match_id", $match_id)
			;
		}

		if($getPointChanges){
			$ret = $ret->leftJoin("userpoints", function($join){
				$join->on("userpoints.user_id","=", "matchdetails.user_id")
				->on("userpoints.match_id","=", "matchdetails.match_id");
			});
		}

		return $ret;
	}

	public static function submitResult($user_id, $match_id, $result){
		$check = Matchdetail::checkResultSubmitted($match_id, $user_id);
		if(!$check){
			switch($result){
				case "won":
						//$eloChangeValue = $eloChange['WinElo'];
				$submissionFor = 1;
				break;
				case "lost":
				$submissionFor = -1;
				break;
				default:
				return false;

				break;
			}
			$updateArray = array(
				"submitted" => 1,
				"submissionFor" => $submissionFor,
				"sub_date" => new DateTime(),
				);
			Matchdetail::where("user_id", $user_id)->where("match_id", $match_id)
			->update($updateArray);
		}
		else{
			return false;
		}
	}
}
