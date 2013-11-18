<?php

class Match extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'matches';
	protected $primaryKey = 'id';

	public static function getAllMatchesPlayed(){
		return Match::where("canceled", 0)
		->where("check", 0)
		->where("team_won_id","!=",-1)
		->where("closed",">",0);
	}

	public static function getAllLiveMatches(){
		return Match::where("canceled", 0)
		->where("check", 0)
		->where("team_won_id",-1)
		->where("closed",0);
	}

	public static function getAllOpenMatches(){
		return Match::where("canceled", 0)
		->where("check", 0)
		->where("team_won_id",-1)
		->where("closed",0);
	}

	public static function isUserInMatch($user_id, $match_id=0){
		// $sql = "SELECT SteamID
  //                                               FROM MatchDetails
  //                                               WHERE MatchID = ".(int)$matchID." AND SteamID = ".secureNumber($steamID)."
  //                                                               LIMIT 1
  //                                                               ";
		if($match_id > 0){
			$user = Matchdetail::where("id", $match_id)->where("user_id", $user_id);
			if(!empty($user)){
				return true;
			}
			else{
				return false;
			}
		}
		else{
 // $sql = "SELECT m.MatchID
 //                                                FROM `Match` m JOIN `MatchDetails` md ON m.MatchID = md.MatchID
 //                                                WHERE md.SteamID = ".secureNumber($steamID)."
 //                                                         AND md.Submitted = 0 AND md.SubmissionFor = 0 AND SubmissionTimestamp = 0
 //                                                                AND m.TeamWonID = -1 AND m.Canceled = 0 AND m.ManuallyCheck = 0 AND m.TimestampClosed = 0
 //                                                                ";
			$user = Match::table("matches")->join('matchdetails', 'matches.match_id', '=', 'matchdetails.match_id')
						->where("user_id", $user_id)
						->where("matchdetails.submitted", "0")
						->where("matchdetails.submissionFor", "0")
						->where("matchdetails.sub_date", "0")
						->where("match.team_won_id", "-1")
						->where("match.canceled", "0")
						->where("match.check", "0")
						->where("match.closed", "0");
			if(!empty($user)){
				return true;
			}
			else{
				return false;
			}
		}
	}
}
