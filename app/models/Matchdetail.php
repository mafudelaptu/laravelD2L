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
				case "cancel":
				$submissionFor = 2;
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

			// delete matched user
			Matched_user::removeMatchedUserEntry($match_id, $user_id);
		}
		else{
			return false;
		}
	}

	public static function getSubmittedMatchdetails($match_id){
		return Matchdetail::getMatchdetailData($match_id, false, true)
		->where("matchdetails.submitted", 1)
		->where("matchdetails.submissionFor","!=", "0");
	}

	public static function getTeamWon($matchdetails){
		$ret = array();
		if(!empty($matchdetails)){
			
			$count = array("1"=>0, "2"=>0);
			foreach ($matchdetails as $key => $md) {
				if($md->submissionFor == "1"){
					$count[$md->team_id]++;
				}
			}

			if($count[1] == $count[2]){
				$teamWonID = 0;
			}
			else{
				arsort($count);
				$teamWonID = key($count);
			}

			$ret['team_won_id'] = $teamWonID;
			$ret['status'] = true;
		}
		else{
			$ret['teamWonID'] = -1;
			$ret['status'] = "matchdetails empty";
		}
		return $ret;
	}

	
}
