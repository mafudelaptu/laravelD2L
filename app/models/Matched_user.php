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

	public static function insertUsers($users, $teamcount, $match_id){
		if(!empty($users)){
			$insertArray = array();
			$countTeam = array(1=>0, 2=>0);
			foreach ($users as $key => $user) {
				$retAve = General::getAvePointsOfTeam($insertArray);
				$team_id = $retAve['data'];

				$tmpArray = array();
				$tmpArray['match_id'] = (int) $match_id;
				$tmpArray['user_id'] = $user->user_id;
				$tmpArray['points'] = $user->rank;
				$tmpArray['ready'] = 0;
				$tmpArray['created_at'] = new DateTime;
				$tmpArray['updated_at'] = new DateTime;
				
				if($countTeam[$team_id] < 5){
					
					$tmpArray['team_id'] = (int) $team_id;
					$countTeam[$team_id]++;

				}
				else{
					if($team_id == 1){
						$team_id = 2;
					}
					else{
						$team_id = 1;
					}
					
					$tmpArray['team_id'] = (int) $team_id;	
					$countTeam[$team_id]++;
				}

				$insertArray[] = $tmpArray;
			}

			Matched_user::insert($insertArray);
			return $insertArray;
		}
	}

	public static function setReadyForUser($user_id){
		Matched_user::where("user_id", $user_id)->update(array("ready" => 1));
	}

	public static function getReadyCount($match_id){
		$ret = Matched_user::where("match_id", $match_id)->where("ready", 1)->count();
		return $ret;
	}

	public static function setAllReady($match_id){
		Matched_user::where("match_id", $match_id)->update(array("ready" => 1));
	}

	public static function removeMatchedUserEntry($match_id, $user_id){
		Matched_user::where("match_id",$match_id)->where("user_id", $user_id)->delete();
	}
}
