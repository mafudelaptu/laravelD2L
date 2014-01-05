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
		->where("team_won_id",0)
		->where("closed","0000-00-00 00:00:00");
	}

	public static function getAllOpenMatchesOfUser($user_id){
		$ret = array();

		$data = Match::getAllOpenMatches()->join("matchdetails", "matchdetails.match_id", "=", "matches.id")
						->leftJoin("matchvotes", function($join) use ($user_id){
							$join->on("matchvotes.match_id", "=", "matches.id")
									->on("matchvotes.user_id", "=", DB::raw($user_id))
									->on("matchvotes.matchvotetype_id", "=", DB::raw(1));
						})
						->where("matchdetails.user_id", $user_id)
						->select(
							"matches.*",
							"matchdetails.submitted",
							DB::raw("IF(COUNT(matchvotes.user_id) > 0, COUNT(matchvotes.user_id), null) as cancelSubmits")
							)
						//->having("cancelSubmits", ">", 0)
						->get();
		// $queries = DB::getQueryLog();
		// dd($queries);
		
		return $data;
	}

	public static function isUserInMatch($user_id, $match_id=0){
		if($match_id > 0){
			$user = Matchdetail::where("match_id", $match_id)->where("user_id", $user_id)->first();
			if(!empty($user)){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			$user = DB::table("matches")->join('matchdetails', 'matches.id', '=', 'matchdetails.match_id')
			->where("matchdetails.user_id", $user_id)
			->where("matchdetails.submitted", "0")
			->where("matchdetails.submissionFor", "0")
			->where("matches.team_won_id", "0")
			->where("matches.canceled", "0")
			->where("matches.check", "0")->get();

			if(!empty($user)){
				return true;
			}
			else{
				return false;
			}
		}
	}

	public static function deleteCreatedMatch($match_id){
		return DB::table("matches")->where("id", $match_id)
		->delete();
	}

	public static function createNewMatch($matchtype_id, $matchmode_id, $region_id){
		$insertArray = array();
		$insertArray['team_won_id'] = 0;
		$insertArray['matchtype_id'] = $matchtype_id;
		$insertArray['matchmode_id'] = $matchmode_id;
		$insertArray['region_id'] = $region_id;
		$insertArray['check'] = 0;
		$insertArray['canceled'] = 0;
		$insertArray['closed'] = 0;
		$insertArray['created_at'] = new DateTime;
		$insertArray['updated_at'] = new DateTime;

		$id = DB::table("matches")->insertGetId($insertArray);

		return $id;
	}

	public static function getStateOfMatch($match_id, $user_id){
		$ret = array();

		$matchData = Match::getMatchData($match_id)->first();

		if(!empty($matchData)){
			if($matchData->team_won_id === 0){
				$submitted = Matchdetail::checkResultSubmitted($match_id, $user_id);				
				
				if($submitted){
					$ret['status'] = "submitted";
				}
				else{
					$ret['status'] = "open";
				}
			}
			elseif($matchData->team_won_id > 0){
				$ret['status'] = "closed";
			}
		}
		else{
			$ret['status'] = "noMatch";
		}
		return $ret;
	}

	public static function getMatchData($match_id, $matchmodeData=false, $regionData=false){
		$ret = Match::where("matches.id", $match_id)->select("matches.*");
		if($matchmodeData){
			$ret = $ret->join("matchmodes", "matchmodes.id", "=", "matches.matchmode_id");
		}
		if($regionData){
			$ret = $ret->join("regions", "regions.id", "=", "matches.region_id");
		}

		return $ret;
	}

	public static function getPlayersData($matchdetailsData, $matchtype_id=0){
		$ret = array();
		if(!empty($matchdetailsData)){
			foreach ($matchdetailsData as $key => $detail) {
				$tmp = array();
				$user_id = $detail['user_id'];
				
				$tmp["user_id"] = $user_id;
				$tmp["name"] = $detail->name;
				$tmp["avatar"] = $detail->avatar;
				$tmp['points'] = (int) $detail->points;
				$tmp['team_id'] = $detail->team_id;
				$tmp['pointschange'] = $detail->pointschange;

				if($matchtype_id > 0){					
					$gameStats = Userpoint::getGameStats($user_id, $matchtype_id);
					$skillbracket_id = Userskillbracket::getSkillbracket($user_id, $matchtype_id, true)->first()->id;
					$skillbrackettypeData = Skillbrackettype::getData($skillbracket_id)->first();

					$tmp["stats"] = $gameStats['data'];
					$tmp['winPoints'] = $skillbrackettypeData->winpoints;
					$tmp['losePoints'] = $skillbrackettypeData->losepoints;
					$tmp['credits'] = Usercredit::getCreditCount($user_id);

				}

				$ret[$detail->team_id][] = $tmp;
			}
		}
		return $ret;
	}
	public static function getAveragePointsOfTeams($matchdetailsData, $matchtype_id){
		$ret = array("team_1"=>0, "team_2"=>0);
		if(!empty($matchdetailsData) && $matchtype_id > 0){
			$rank_team = 0;
			for($i=1; $i<=2; $i++){
				$elo_sum = 0;

				foreach($matchdetailsData as $k => $v){
					if($v->team_id == $i){

						$elo_sum += $v->points;
					}
				}
				switch($matchtype_id){
					case "2":
					$rank_team = (int) $elo_sum;
					break;
					default:
					$rank_team = (int) $elo_sum / 5;
				}

				$ret['team_'.$i]= round($rank_team,0);
			}
		}
		return $ret;
	}

	public static function setMatchToManuallyCheck($match_id){
		$updateArray = array(
			"check" => 1,
			);

		return Match::where("id", $match_id)->update($updateArray);
	}

	public static function setTeamWon($match_id, $team_won_id){
		$updateArray = array(
			"team_won_id" => $team_won_id,
			"closed" => new DateTime(),
			);
		Match::where("id", $match_id)->update($updateArray);
	}

	public static function getLeaverTeamCounts($match_id, $matchdetails, $matchtype_id){
		if(!empty($matchdetails)){
			$leaverArray = array(1=>0, 2=>0);
			$leaverUserArray = array();
			foreach ($matchdetails as $key => $md) {
				$team_id = $md->team_id;
				$user_id = $md->user_id;
				
				// check enough leaver votes
				$leaveData = Matchvote::getAllLeaverVotesForUser($match_id, $user_id)->groupBy("vote_for_user")
				->select("matchvotes.*", DB::raw("Count(vote_for_user) as leaveCount"))->first();

				if(!empty($leaveData)){
					switch ($matchtype_id) {
					case 2: // 1vs1
					break;
					default: // 5vs5
					if($leaveData->leaveCount >= 6){
						$leaverArray[$team_id]++;
						$leaverUserArray[] = $leaveData->vote_for_user;
					}
					break;
				}
			}
		}

		$leaverArray['leaver'] = $leaverUserArray;

		if($leaverArray[1] > 0 || $leaverArray[2] > 0){
			$maxs = array_keys($array, max($array));
			$leaverArray['handicapped'] = $maxs;
		}
		else{
			$leaverArray['handicapped'] = false;
		}
		return $leaverArray;
	}
}

public static function playerLeftTheMatch($user_id, $match_id){
	$ret = array();
	if($user_id > 0 && $match_id > 0){
			$leavercount = Matchvote::getAllLeaverVotesForUser($match_id, $user_id)->count();

			if($leavercount >= 6){
				$ret['leaver'] = true;
			}
			else{
				$ret['leaver'] = false;
			}

			$ret['status'] = true;
	}
	else{
		$ret['status'] = "steamID = 0 or matchid = 0";
	}

	return $ret;
}


public static function getLastMatches($user_id, $count){
	$ret = array();
	$data = Match::join("matchdetails", "matches.id", "=", "matchdetails.match_id")
					->join("userpoints", function($join){
						$join->on("matches.id", "=", "userpoints.match_id");
					})
					->join("matchmodes", "matchmodes.id", "=", "matches.matchmode_id")
					->join("matchtypes", "matchtypes.id", "=", "matches.matchtype_id")
					->where("userpoints.user_id", $user_id)
					->where("matchdetails.user_id", $user_id)
					->where("matches.team_won_id", "!=", 0)
					->where("matches.canceled", 0)
					->where("matches.check", 0)
					->select("matches.*", 
						"matchdetails.team_id", 
						"matchmodes.name as matchmode", 
						"matchtypes.name as matchtype", 
						"matchmodes.shortcut as mm_shortcut", 
						"userpoints.pointschange")->take($count)->get();
	if(!empty($data)){
		$leaverArray = array();
		foreach ($data as $key => $match) {
			$match_id = $match->id;
			$retLeaver = Match::playerLeftTheMatch($user_id, $match_id);
			$leaver = $retLeaver['leaver'];

			$leaverArray[$match->id] = $leaver;
		}
		$ret["data"] = $data;
		$ret['leaverArray'] = $leaverArray;
		$ret['status'] = true;
	}
	else{
		dd(DB::getQueryLog());
	}
	return $ret;
}

}
