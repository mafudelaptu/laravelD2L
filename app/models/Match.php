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
		if($match_id > 0){
			$user = Matchdetail::where("match_id", $match_id)->where("user_id", $user_id);
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
			->where("matchdetails.sub_date", "0")
			->where("matches.team_won_id", "0")
			->where("matches.canceled", "0")
			->where("matches.check", "0")
			->where("matches.closed", "0")->get();
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
		$insertArray['closed'] = null;
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

	public static function getMatchData($match_id){
		$ret = Match::where("id", $match_id);
		return $ret;
	}

	public static function getPlayersData($matchdetailsData, $matchtype_id){
		$ret = array();
		if(!empty($matchdetailsData)){
			foreach ($matchdetailsData as $key => $detail) {
				$tmp = array();
				$user_id = $detail->user_id;

				$gameStats = Userpoint::getGameStats($user_id, $matchtype_id);
				$skillbracket_id = Userskillbracket::getSkillbracket($user_id, $matchtype_id, true)->first()->id;
				$skillbrackettypeData = Skillbrackettype::getData($skillbracket_id)->first();
				
				$tmp["user_id"] = $user_id;
				$tmp["name"] = $detail->name;
				$tmp["avatar"] = $detail->avatar;
				$tmp["stats"] = $gameStats['data'];
				$tmp['points'] = (int) $detail->points;
				$tmp['team_id'] = $detail->team_id;
				$tmp['winPoints'] = $skillbrackettypeData->winpoints;
				$tmp['losePoints'] = $skillbrackettypeData->losepoints;
				$tmp['credits'] = Usercredit::getCreditCount($user_id);

				$ret[] = $tmp;
			}
		}
		return $ret;
	}
}
