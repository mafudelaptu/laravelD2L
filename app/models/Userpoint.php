<?php

class Userpoint extends Eloquent {
	protected $guarded = array();
	protected $table = "userpoints";
	public static $rules = array();


	public static function getPoints($user_id, $matchtype_id=0){
		$ret = 0;

		$points = DB::table("userpoints")->where("user_id", $user_id);
		$basePoints = Auth::user()->basePoints;
		switch($matchtype_id){
			case 0:
			case 1:
			$points = $points->where(function($query){
				$query->where("matchtype_id", 0)->orWhere("matchtype_id", 1);
			})->remember(10);
			break;
			default:
			$points = $points->where("matchtype_id", $matchtype_id)->remember(10);
		}
		$points = $points->sum("pointschange");
		$ret = $basePoints+$points;
		return $ret;
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
			->where("pointstype_id", 1)
			->where("matchtype_id", $matchtype_id)->remember(10);
			$wins = (int) $data->count();

			// Losses
			$data = Userpoint::where("user_id",$user_id)
			->where("pointstype_id", 2)
			->where("matchtype_id", $matchtype_id)->remember(10);
			$losses = (int) $data->count();

			// Leaves
			$data = Userpoint::where("user_id",$user_id)
			->where("pointstype_id", 5)
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

	public static function insertPointChanges($match_id, $team_won_id, $matchdetails, $playerData, $matchmode_id){
		// Matchmode bonus
		$matchmodeData = Matchmode::getMatchmodeData($matchmode_id)->first();
		$matchmodeBonus = $matchmodeData->bonus;

		// Handicap and Leavercounts
		$leaverData = Match::getLeaverTeamCounts($match_id, $matchdetails);

		if(!empty($playerData)){
			for($i=1; $i<=2; $i++){
				foreach ($playerData[$i] as $key => $md) {
					$user_id = $md->user_id;
					$team_id = $md->team_id;
					$losePoints = $md->losePoints;
					$winPoints = $md->winPoints;
					
					$winPoints = $winPoints + $matchmodeBonus;
					if($leaverData['handicapped'] == $team_won_id){
						
						if($team_won_id == $team_id){
							
						}
						else{

						}
					}
					else{
						// WIN
						if($i == $team_won_id){

						}
						//LOSE
						else{

						}	
					}
					
				}	
			}
		}		
	}
}
