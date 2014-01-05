<?php

class Userpoint extends Eloquent {
	protected $guarded = array();
	protected $table = "userpoints";
	public static $rules = array();


	public static function getPoints($user_id, $matchtype_id=0){
		$ret = 0;
		$userData = User::getUserData($user_id)->first();
		$basePoints = $userData->basePoints;
		$points = Userpoint::getPointsData($user_id, $matchtype_id);
		$points = $points->sum("pointschange");
		$ret = $basePoints+$points;
		return $ret;
	}

	public static function getPointsData($user_id, $matchtype_id=0){
		$points = DB::table("userpoints")->where("userpoints.user_id", $user_id);
		switch($matchtype_id){
			case 0:
			break;
			case 1:
			$points = $points->where("userpoints.matchtype_id", 1);
			break;
			default:
			$points = $points->where("userpoints.matchtype_id", $matchtype_id);
		}
		return $points;
	}

	public static function getGameStats($user_id, $matchtype_id){
		$ret = array();

		if($user_id > 0){
			$wins = 0;
			$losses = 0;
			$totalGames = 0;
			$winRate = 0;

			// Wins
			$data = Userpoint::where("user_id",$user_id)
			->where("pointtype_id", 1)
			->where("matchtype_id", $matchtype_id)->remember(10);
			$wins = (int) $data->count();

			// Losses
			$data = Userpoint::where("user_id",$user_id)
			->where("pointtype_id", 2)
			->where("matchtype_id", $matchtype_id)->remember(10);
			$losses = (int) $data->count();

			// Leaves
			$data = Userpoint::where("user_id",$user_id)
			->where("pointtype_id", 5)
			->where("matchtype_id", $matchtype_id)->remember(10);
			$leaves = (int) $data->count();

			$totalGames = (int) $wins+$losses;
			if($totalGames > 0){
				$winRate = round(($wins/$totalGames)*100,2);
			}
			else{
				$winRate = 0;
			}
			$tmp = array();
			$tmp['Wins'] = $wins;
			$tmp['Losses'] = $losses;
			$tmp['TotalGames'] = $totalGames;
			$tmp['WinRate'] = $winRate;
			$tmp['Leaves'] = $leaves;

			$ret['data']  =$tmp;
			$ret['status'] = true;
		}
		else{
			$ret['status'] = "user_id = 0";
		}

		return $ret;
	}

	public static function insertPointChanges($match_id, $team_won_id, $matchdetails, $playerData, $matchmode_id, $matchtype_id){
		$ret = array();

		// Matchmode bonus
		$matchmodeData = Matchmode::getMatchmodeData($matchmode_id)->first();

		$matchmodeBonus = $matchmodeData->bonus;

		// Handicap and Leavercounts
		$leaverData = Match::getLeaverTeamCounts($match_id, $matchdetails, $matchtype_id);

		if(!empty($playerData)){
			for($i=1; $i<=2; $i++){
				foreach ($playerData[$i] as $key => $md) {
					$user_id = $md['user_id'];
					$team_id = $md['team_id'];
					$losePoints = $md['losePoints'];
					$winPoints = $md['winPoints'];
					
					$winPoints = $winPoints + $matchmodeBonus;
					$pointChange = 0;
					if($leaverData['handicapped'] == $team_won_id){
						if(in_array($user_id, $leaverData['leaver'])){
							$punishment = Globalsetting::getMatchLeaverPunishment();
							$pointChange = $punishment;
							$pointsType = 5;
						}
						else{ 
							if($team_won_id == $team_id){
								$pointChange = $winPoints;
								$pointsType = 1;
							}
							else{
								$pointChange = -0;
								$pointsType = 2;
							}	
						}
					}
					else{
						if($team_won_id == $team_id){
							$pointChange = $winPoints;
							$pointsType = 1;
						}
						else{
							$pointChange = $losePoints*(-1);
							$pointsType = 2;
						}
					}

					if($pointsType > 0){
						$insertArray = array(
							"user_id" => $user_id,
							"matchmode_id" => $matchmode_id,
							"matchtype_id" => $matchtype_id,
							"match_id" => $match_id,
							"pointtype_id" => $pointsType,
							"pointschange" => $pointChange,
							"created_at" => new DateTime,
							);

						Userpoint::insert($insertArray);

						$ret['status'] = true;
					}
					else{
						$ret['status'] = "pointtype_id = 0";
					}
				}
			}		
		}

		return $ret;
	}


	public static function getPointsHistoryData($matchmode_id, $matchtype_id, $user_id, $count="*"){
		$userData = User::getUserData($user_id)->first();
		$basepoints = $userData->basePoints;

		$data = Userpoint::getPointsData($user_id, $matchtype_id);

		$data->join("matches", "matches.id", "=", "userpoints.match_id")
		->join("matchmodes", "matchmodes.id", "=", "userpoints.matchmode_id")
		->join("matchtypes", "matchtypes.id", "=", "userpoints.matchtype_id")
		->join("pointtypes", "pointtypes.id", "=", "userpoints.pointtype_id")
		->where("userpoints.user_id", $user_id)
		->where("userpoints.matchtype_id", $matchtype_id);

		if($matchmode_id != "*"){
			$data->where("userpoints.match_id", ">", 0);
			$data->where("userpoints.matchmode_id",$matchmode_id);
		}

		$data->select(
			"userpoints.pointschange",
			"userpoints.match_id",
			"userpoints.event_id",
			"matchtypes.name as matchtype",
			"matchmodes.name as matchmode",
			"matchtypes.name as matchtype",
			"matchtypes.name as matchtype",
			"pointtypes.name as pointtype"
			);
		$data = $data->orderBy("userpoints.created_at", "asc")->get();
		// $query = DB::getQueryLog();
		// die($query[2]['query']);
		// für Highchart aufbereiten
		if(!empty($data)){
			
			if($matchmode_id == "*"){
				$elo = (int)$basepoints;
			}
			else{
				$elo = 0;
			}

		// Startwert hinzufï¿½gen
			$retData[0] = $elo;
			$retKeys[0] = 0;
			$retPointsType[0] = "";
			$retMatchMode[0] = "";
			$retMatchType[0] = "";
			$retPointsChange[0] = 0;
			$retIDText[0] = "Initialization";

			foreach ($data as $k => $v) {
				$pointsChange  = $v->pointschange;
				$elo += (int)$pointsChange;
				$retData[] = $elo;
				$retKeys[] = $v->match_id;
				$retPointsType[] = $v->pointtype;
				$retMatchMode[] = $v->matchmode;
				$retMatchType[] = $v->matchtype;
				$retPointsChange[] =  $v->pointschange;

				if($v->match_id == "0"){
					$retIDText[] = "Event #".$v->event_id;
				}
				else{
					$retIDText[] = "Match #".$v->match_id;
				}

				$matchMode = $v->matchmode;
				$matchType = $v->matchtype;
			}

			if($count != "*"){
				(count($retData) > (int)$count ? $anfang=(count($retData)-(int)$count): $anfang=0);
				$retData = array_slice($retData,$anfang,(int)$count);
				$retKeys = array_slice($retKeys,$anfang,(int)$count);
				$retPointsType = array_slice($retPointsType,$anfang,(int)$count);
				$retMatchMode = array_slice($retMatchMode,$anfang,(int)$count);
				$retMatchType = array_slice($retMatchType,$anfang,(int)$count);
				$retPointsChange = array_slice($retPointsChange,$anfang,(int)$count);
				$retIDText = array_slice($retIDText,$anfang,(int)$count);
			}

			$ret['data'] = $retData;

			$ret['xAxis'] = $retKeys;
			$ret['matchModeArr'] = $retMatchMode;
			$ret['MatchTypeArr'] = $retMatchType;
			$ret['pointsType'] = $retPointsType;
			$ret['pointsChange'] = $retPointsChange;
			$ret["idText"] = $retIDText;
			$ret['matchType'] = $matchType;
			$ret['matchMode'] = $matchMode;
			$ret['status'] = true;
		}
		else{
			$ret['status'] = "data = null";
		}

		
		return $ret;
	}

	public static function getPointRoseData($user_id, $matchtype_id=1){
		$ret = array();

		$data = Userpoint::getPointsData($user_id)
		->join("matchmodes", "matchmodes.id", "=", "userpoints.matchmode_id")
		->where("user_id", $user_id)
		->where("matchtype_id", $matchtype_id)
		->select(DB::raw("IF(SUM(pointschange) > 0, SUM(pointschange), 0) as PointsEarned"),
			"matchmodes.name as matchmode",
			"userpoints.matchmode_id")
		->groupBy("matchmode_id")->get();

		if(!empty($data)){
			$retKeys = array();
			$retData = array();
			foreach($data as $k => $v){
				$retKeys[] = $v->matchmode;
				$retData[] = (int) $v->PointsEarned;
			}
		}
		else{
			$ret['status'] = "data = null";
		}

		$ret['data'] = $retData;
		$ret['keys'] = $retKeys;

		$ret['status'] = true;
		return $ret;
	}
}