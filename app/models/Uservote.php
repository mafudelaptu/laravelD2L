<?php

class Uservote extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = "uservotes";
	protected $primaryKey = array("vote_of_user", "match_id", "user_id");

	public static function insertVote($user_id, $vote_user_id, $votetype_id, $match_id){
		if ($user_id > 0 && $vote_user_id > 0 && $votetype_id > 0 && $match_id > 0) {
			$check = Uservotecount::allowedToVote($votetype_id, $user_id);
			if($check){
				

				$insertArray = array(
					"user_id" => $vote_user_id,
					"vote_of_user" => $user_id,
					"votetype_id" => $votetype_id,
					"match_id" => $match_id,
					"created_at" => new DateTime(),
					);

				Uservote::insert($insertArray);
				// if +vote -> credit bonus
				if($votetype_id == "1"){
					Usercredit::insertCredit($user_id, $vote_user_id, 1, $match_id);
					return true;
				}
			}
			else{
				return false;
			}
		}
		else{
				return false;
		}
	}

	public static function getVotesOfUser($user_id, $match_id){
		return Uservote::where("vote_of_user", $user_id)->where("match_id", $match_id);
	}

	public static function getVoteStatsForMatch($match_id, $matchdetailsData = false){
		if($matchdetailsData != false){
			$data = Uservote::where("match_id", $match_id)->get();
			if(!empty($data)){
				$retArray = array();
				foreach ($data as $key => $userdata) {
					$user_id = $userdata->user_id;
					$votetype_id = $userdata->votetype_id;
					if(empty($retArray[$user_id])){
						$retArray[$user_id] = array("posVotes"=>0, "negVotes" => 0);
					}
					switch ($votetype_id) {
						case 1:
							$retArray[$user_id]['posVotes']++;
							break;
						case 2:
							$retArray[$user_id]['negVotes']++;
							break;
						
						default:
							
							break;
					}
				}
				return $retArray;
			}
		}
	}

	public static function getVotesOfAllMatches(){
		return Uservote::where("uservotes.updated_at", "0000-00-00 00:00:00");
	}

}
