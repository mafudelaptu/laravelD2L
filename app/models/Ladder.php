<?php

class Ladder extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function getRanking($user_id, $matchtype_id, $skillbracket_id=null, $points=null){
		if($skillbracket_id == null){
			$sbData = Userskillbracket::getSkillbracket($user_id, $matchtype_id)->first();
			$skillbracket_id = $sbData->skillbrackettype_id;
		}
		if($points == null){
			$points = Userpoint::getPoints($user_id, $matchtype_id);
		}

		$data = Userpoint::join("userskillbrackets", "userskillbrackets.user_id", "=", "userpoints.user_id")
					->join("users", "users.id", "=", "userpoints.user_id")
					->where("userpoints.matchtype_id", $matchtype_id)
					->where("userskillbrackets.skillbrackettype_id", $skillbracket_id)
					->select("userpoints.user_id",
						DB::raw("SUM(userpoints.pointschange)+users.basePoints as Points"),
						"userskillbrackets.skillbrackettype_id")
					->groupBy("userpoints.user_id")
					->havingRaw("Points >= ".(int) $points." OR userskillbrackets.skillbrackettype_id > ".(int)$skillbracket_id."")
					->orderBy("userskillbrackets.skillbrackettype_id","desc")
					->orderBy("Points", "desc")->get();
		//$queries = DB::getQueryLog();
		//die($queries[9]['query']);
		//dd(count($data));

		return count($data);
	}

	public static function getBestPlayers($matchtype_id, $count="5"){
		$data = Userpoint::join("users","users.id", "=", "userpoints.user_id")
					->where("userpoints.matchtype_id", $matchtype_id)
					->groupBy("userpoints.user_id")
					->select(
						"users.*",
						"userpoints.*",
						DB::raw("(SUM(userpoints.pointschange)+users.basePoints) as points")
						)
					->orderBy("points", "desc")
					->take($count)
					->get();
		 // $queries = DB::getQueryLog();
		 // die($queries[3]['query']);
		if(!empty($data)){
			foreach ($data as $key => $user) {
				
				$user_id = $user->user_id;
				$gameStatsData = Userpoint::getGameStats($user_id, $matchtype_id);
				
				$credits = Usercredit::getCreditCount($user_id);
				
				$data[$key] = array_add($data[$key], "stats", $gameStatsData['data']);
				$data[$key] = array_add($data[$key], 'credits', $credits);
			}

			return $data;
		}
	}
}
