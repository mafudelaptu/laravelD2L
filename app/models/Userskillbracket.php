<?php

class Userskillbracket extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'userskillbrackets';

	const totalGamesAmateur = 20;
	const totalGamesSkilled = 50;
	const totalGamesExpert = 100;
	const totalGamesMaster = 150;
	const winRateAmateur = 45;
	const winRateSkilled = 48;
	const winRateExpert = 51;
	const winRateMaster = 52.5;

	public function users(){
		return $this->hasOne("User", "user_id");
	}

	public static function getSkillbracket($user_id, $matchtype_id=0, $cache=false){
		switch ($matchtype_id) {
			case 0:
				$data = DB::table("userskillbrackets")
							->join('skillbrackettypes', 'userskillbrackets.skillbrackettype_id', '=', 'skillbrackettypes.id')
							->where("user_id",$user_id);			
				break;
			default:
				$data = DB::table("userskillbrackets")
								->join('skillbrackettypes', 'userskillbrackets.skillbrackettype_id', '=', 'skillbrackettypes.id')
								->where("user_id",$user_id)
								->where("matchtype_id", $matchtype_id);
			break;
		}
		if($cache){
			$data = $data->remember(30);
		}
		return $data;
	}

	public static function getSkillbracketsAsArray($user_id, $fullMatchtypes=false){
		$sbArray = array();
		if($fullMatchtypes){
			$matchtypes = MatchType::getAllActiveMatchtypes()->get();
			if(!empty($matchtypes)){
				foreach ($matchtypes as $k => $matchtype) {
					$matchtype_id = $matchtype->id;
					$data = DB::table("userskillbrackets")
							->join('skillbrackettypes', 'userskillbrackets.skillbrackettype_id', '=', 'skillbrackettypes.id')
							->where("user_id",$user_id)
							->where("matchtype_id", $matchtype_id)
							->first();	
					if(!empty($data)){
							$tmp = array(
								"skillbrackettype_id" => $data->skillbrackettype_id,
								"skillbracket" => $data->name,
								);
							$sbArray[$matchtype_id] = $tmp;
					}
					else{
						$tmp = array(
								"skillbrackettype_id" => 0,
								"skillbracket" => "",
								);
						$sbArray[$matchtype_id] = $tmp; 
					}
				}
			}
		}
		else{
			$data = DB::table("userskillbrackets")
							->join('skillbrackettypes', 'userskillbrackets.skillbrackettype_id', '=', 'skillbrackettypes.id')
							->where("user_id",$user_id)->get();			
			if(!empty($data)){
				
				foreach ($data as $key => $sb) {
					$matchtype_id = $sb->id;

					$tmp = array(
								"skillbrackettype_id" => $sb->skillbrackettype_id,
								"skillbracket" => $sb->name,
								);
					$sbArray[$matchtype_id] = $tmp;
				}
			}
		}
		
		
		return $sbArray;
	}

	public static function setSkillbrackets($user_id){
		$ret = array();

		if($user_id > 0){
			$matchtypes = MatchType::getAllActiveMatchtypes()->get();

			if(!empty($matchtypes)){
				foreach ($matchtypes as $k => $matchtype) {

					$matchtype_id = $matchtype->id;
					$checkTimestamp = 120; // 2 mins

					$checkSkillBracket = Userskillbracket::where("user_id", $user_id)
					->where("matchtype_id", $matchtype_id);
					
					if($checkSkillBracket->count() > 0){
						$data = $checkSkillBracket->first();
						
						$last_check = $data->last_check;
						$last_check_time = strtotime($last_check);
						
						
						if($last_check_time <= (time()-$checkTimestamp)){
							$skillbracket_id = $data->skillbrackettype_id;
							
							$retSB = Userskillbracket::getSkillBracketByStats($user_id, $matchtype_id);
							$skillBracketTypeIDByStats = $retSB['data'];

							if($skillbracket_id != $skillBracketTypeIDByStats){
								
								$updateArray = array(
									"skillbrackettype_id" => $skillBracketTypeIDByStats,
									"skillbracket_before" => $skillbracket_id,
									"updated_at" => new DateTime,
									"last_check" => new DateTime
									);
								$retUpd = DB::table("userskillbrackets")->where("user_id", $user_id)
								->where("matchtype_id", $matchtype_id)
								->update($updateArray);

								$ret['status'] = "skillbracket erfolgreich geändert";
							}
							else{
								$ret['status'] = "skillbracket gleich";
							}
						}
						else{
							$ret['status'] = "zu frueh";
						}
					}
					else{
						// nicht angelegt
						$insertArray = array();
						$insertArray['user_id'] = $user_id;
						$insertArray['matchtype_id'] = (int)$matchtype_id;
						$insertArray['skillbrackettype_id'] = 2;
						$insertArray['skillbracket_before'] = 0;
						$insertArray['last_check'] = new DateTime;
						$insertArray['created_at'] = new DateTime;
						$insertArray['updated_at'] = new DateTime;

						$retIns = DB::table("userskillbrackets")->insert($insertArray);
						
					}
				}
			}

		}
		else{
			$ret['status'] = "user_id == 0";
		}
		return $ret;
	}
	public static function getSkillBracketByStats($user_id, $matchtype_id){
		$ret = array ();
		$ret['debug'] = "";
		$ret['data'] = null;
		if ($user_id > 0) {

			// Get current total Games and winrate of user
			$userStats = Userpoint::getGameStats($user_id, $matchtype_id);
			$userStats = $userStats['data'];
			// get current CreditCount
			$creditsCount = Usercredit::getCreditCount($user_id);

			// get current active Bans of User
			$retAB = Banlist::getAllActiveBans($user_id);
			$activeBansCount = $retAB->count();
			if($activeBansCount > 0){
				// sonst Prison
				$ret ['data'] = 1;
			}
			else{
				$calcSkillBracket = Userskillbracket::getFitSkillBracketByStats ( $userStats ['TotalGames'], $userStats ['WinRate'], $creditsCount, $activeBansCount );
				$ret ['data'] = $calcSkillBracket ['data'];
			}

			$ret ['status'] = true;
		} else {
			$ret ['status'] = "steamID == 0";
		}
		$ret ['debug'] .= "End getSkillBracketOfUserByStats <br>\n";
		return $ret;
	}

	public static function getFitSkillBracketByStats($totalGames, $winRate, $creditsCount, $activeBans){
		$ret = array ();

		$ret ['debug'] = "Start getFitSkillBracketByStats <br>\n";

		$warnsBorder = $activeBans*10;

		$ret ['debug'] .= "tG:" . $totalGames . " wR:" . $winRate . " cC:" . $creditsCount . " aB:" . $activeBans." wB:".$warnsBorder;

		// test Master
		if ($totalGames >= Userskillbracket::totalGamesMaster && $winRate >= Userskillbracket::winRateMaster && $creditsCount > 0 && $totalGames >= $warnsBorder) {
			$ret ['data'] = 6;
			return $ret;
		} else if ($totalGames >= Userskillbracket::totalGamesExpert && $winRate >= Userskillbracket::winRateExpert && $creditsCount > 0 && $totalGames >= $warnsBorder) {
			$ret ['data'] = 5;
			return $ret;
		} else if ($totalGames >= Userskillbracket::totalGamesSkilled && $winRate >= Userskillbracket::winRateSkilled && $creditsCount > 0 && $totalGames >= $warnsBorder) {
			$ret ['data'] = 4;
			return $ret;
		} else if ($totalGames >= Userskillbracket::totalGamesAmateur && $winRate >= Userskillbracket::winRateAmateur && $creditsCount > 0 && $totalGames >= $warnsBorder) {
			$ret ['data'] = 3;
			return $ret;
		} else {
			$ret ['data'] = 2;
			return $ret;
		}
		$ret ['debug'] .= "End getFitSkillBracketByStats <br>\n";
		return $ret;
	}
}
