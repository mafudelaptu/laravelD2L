<?php

class CronjobDoAllController extends BaseController {

	public function doAllCronjobs(){
		$ret = "";
		/**
		  * Match
		*/
		// cancel Matches
		$ret .= $this->cancelMatchHandling();
		
		// uservotes handling
		$ret .= $this->uservotesHandling();
		
		// (usercredits)ban handling
		$ret .= $this->bansHandling();

		// Match result handling
		$ret .= $this->matchResultHandling();
		

		/**
		*	General
		*/
		// weekly Votecounts reset
		$ret .= $this->updateVoteCounts();

		// permaban handling
		$ret .= $this->permabanActiveBansHandling();

		// active bans decay
		$ret .= $this->activeBansDecayHandling();


		return $ret;
	}

	public function matchResultHandling(){
		$ret = "=== Matches Result Handling === \n\r";

		$openMatches = Match::getAllOpenMatches()->get();
		if(!empty($openMatches)){
			foreach ($openMatches as $key => $match) {
				$match_id = $match->id;
				$matchmode_id = $match->matchmode_id;
				$matchtype_id = $match->matchtype_id;

				$submittedCount = Matchdetail::getSubmittedMatchdetails($match_id)->count();
				switch ($matchtype_id) {
					case 2: // 1vs1
					if($submittedCount >= 2){
						$matchdetailsData = Matchdetail::getMatchdetailData($match_id, false, false)->orderBy("matchdetails.points")
						->select("matchdetails.*")
						->get();

						$matchPlayersData = Match::getPlayersData($matchdetailsData, $matchtype_id);

						$check = $this->checkSubmissions($matchdetailsData, $matchtype_id);

						if($check['status'] == true){
							$teamWonData = Matchdetail::getTeamWon($matchdetailsData);
							$team_won_id = $teamWonData['team_won_id'];
							if($team_won_id > 0){
								Match::setTeamWon($match_id, $team_won_id);
									// set Point-changes
								$retUP = Userpoint::insertPointChanges($match_id, $team_won_id, $matchdetailsData, $matchPlayersData, $matchmode_id, $matchtype_id);

								$ret .= "Match: ". $match_id." entered result ".$retUP['status']." TeamWon: ".$team_won_id."\n\r";
							}
							else{
								$ret .= "Match: ". $match_id." - couldnt detect team won id! \n\r";
							}
						}
						else{
							Match::setMatchToManuallyCheck($match_id);
							$ret .= "Match: ". $match_id." - manually check! \n\r";
						}
					}
					else{
						$ret .= "Match: ". $match_id." - just ".$submittedCount. " submits yet! \n\r";
					}		
					break;
					
					default: // 5vs5
					if($submittedCount >= 8){
						$matchdetailsData = Matchdetail::getMatchdetailData($match_id, false, false)->orderBy("matchdetails.points")
						->select("matchdetails.*")
						->get();
						
						$matchPlayersData = Match::getPlayersData($matchdetailsData, $matchtype_id);

						$check = $this->checkSubmissions($matchdetailsData, $matchtype_id);

						if($check['wrongSubmissions'] <= 2){
							$teamWonData = Matchdetail::getTeamWon($matchdetailsData);
							$team_won_id = $teamWonData['team_won_id'];
							if($team_won_id > 0){
								Match::setTeamWon($match_id, $team_won_id);
								// set Point-changes
								$retUP = Userpoint::insertPointChanges($match_id, $team_won_id, $matchdetailsData, $matchPlayersData, $matchmode_id, $matchtype_id);
								
								$ret .= "Match: ". $match_id." entered result ".$retUP['status']." TeamWon: ".$team_won_id."\n\r";
							}
							else{
								$ret .= "Match: ". $match_id." - couldnt detect team won id! \n\r";
							}
						}
						else{
							Match::setMatchToManuallyCheck($match_id);
							$ret .= "Match: ". $match_id." - manually check! \n\r";
						}
					}
					else{
						$ret .= "Match: ". $match_id." - just ".$submittedCount. " submits yet! \n\r";
					}					
					break;
				}
			}
		}
		return $ret."\n\r";
	}

	public function checkSubmissions($matchdetails, $matchtype_id){
		$ret = array();

		if(!empty($matchdetails)){
			switch($matchtype_id){
				case 2: // 1vs1
				$countWins = 0;
				foreach ($matchdetails as $k => $v) {
					if($v->submissionFor == 1){
						$countWins++;
					}
				}

				if($countWins > 1){
					$ret['status'] = false;
				}
				else{
					$ret['status'] = true;
				}

				break;
				default: // 5vs5 single etc
				$countWin = array("1"=>0, "2"=>0);
				foreach ($matchdetails as $k => $v){
					$teamID = $v->team_id;
						// WIN
					if($v->submissionFor == 1){
						$countWin[$teamID]++;
					}
				}

					// wenn von beiden seiten auf win getippt wurde -> haben n problem
				$falscherWert = 0;
				if($countWin[1] > 0  && $countWin[2] > 0){

					$min = min($countWin[1],$countWin[2] );

						// �ber 2 haben dagegen gestimmt -> nun haben wir wirklich n problem
					$falscherWert = $min;
				}
				$ret['wrongSubmissions'] = $falscherWert;
				$ret['status'] = true;
				break;
			}
		}
		else{
			$ret['status'] = "matchdetails empty";
		}

		return $ret;
	}

	public function cancelMatchHandling(){
		$ret = "=== Cancel Matches === \n\r";
		$matchtypes = Matchtype::getAllActiveMatchtypes()->get();
		if(!empty($matchtypes)){
			foreach ($matchtypes as $key => $mt) {
				$matchtype_id = $mt->id;
				$cancelBorder = GlobalSetting::getCancelBorderForMatchtype($matchtype_id);

				$openMatches = Match::getAllOpenMatches()->join("matchvotes", "matchvotes.match_id", "=", "matches.id")
				->where("matchvotes.matchvotetype_id", 1)
				->where("matchvotes.updated_at", "0000-00-00 00:00:00")
				->groupBy("matchvotes.match_id")
				->select(
					"matches.*",
					DB::raw("COUNT(matchvotes.user_id) as cancelCount")
					)
				->having("cancelCount", ">=", $cancelBorder);

				$openMatchesData = $openMatches->get();
				//dd($openMatchesData);
				if(!empty($openMatchesData)){
					foreach ($openMatchesData as $key => $m) {
					// schauen ob auch mit leaver
						$leaverVotes = Matchvote::getAllLeaverVotesCountsForMatch($m->id)->get();
						$leaverArray = array();

						if(!empty($leaverVotes)){
							$leaverRet = "";
							foreach ($leaverVotes as $key => $l) {
								//dd($l);
								if($l->leaverVotes >= 6){
									$leaverArray[] = $l->vote_for_user;
								}
								else{
									$leaverRet .= "   just ".$l->leaverVotes." vote for ".$l->vote_for_user." \n\r";
								}
							}
						}

				// match canceln
						$updateArray = array(
							"canceled" => 1,
							"closed" => new DateTime,
							);
						Match::where("id", $m->id)->update($updateArray);

						$ret .= "Match: ".$m->id." canceled \n\r";
						$ret .= $leaverRet;
				// wenn leaver drin  dann auch noch bestrafen
						if(is_array($leaverArray) && count($leaverArray) > 0){
							foreach($leaverArray as $k =>$v){
								$insertArray = array(
									"user_id" => $v,
									"matchmode_id" => $m->matchmode_id,
									"matchtype_id" => $m->matchtype_id,
									"match_id" => $m->id,
									"pointtype_id" => 5,
									"matchmode_id" => $m->matchmode_id,
									"pointschange" => GlobalSetting::getMatchLeaverPunishment(),
									"created_at" => new DateTime,
									);
								Userpoint::insert($insertArray);
								$ret .= "       Leaver punished: ".$v."\n\r";
							}
						}

						$updateArray = array(
							"updated_at" => new DateTime
							);
						Matchvote::where("match_id", $m->id)->update($updateArray);
					}
				}
				else{
					$ret .= "no open Matches... \n\r";
				}
			}
		}
		else{
			$ret .= "no active matchtypes";
		}
		return $ret."\n\r";
	}

	public function uservotesHandling(){
		$ret = "=== Uservotes Handling === \n\r";

		$uservotesData = Uservote::getVotesOfAllMatches()
		->join("votetypes", "votetypes.id", "=", "uservotes.votetype_id")
		->get();
		if(!empty($uservotesData)){
			// rewrite Array for later
			$matchArray = array();
			foreach ($uservotesData as $key => $uv) {
				$matchArray[$uv->match_id][] = $uv;
			}
			if(is_array($matchArray) && count($matchArray) > 0){
				foreach($matchArray as $k =>$v){
					$match_id = $k;
					foreach ($v as $key => $vote) {
						
						Usercredit::insertCredit($vote->user_id, $vote->vote_of_user, $vote->weight, $match_id);
						$ret .= " inserted '".$vote->weight."' Credits for ".$vote->user_id." of ".$vote->vote_of_user." (match_id:".$match_id.") \n\r";
						// set on edited
						$updateArray = array(
							"updated_at"=>new DateTime,
							);
						Uservote::where("user_id", $vote->user_id)
						->where("vote_of_user", $vote->vote_of_user)
						->where("match_id", $match_id)
						->update($updateArray);
					}
					
				}
			}
			else{
				$ret .= "matchArray is empty \n\r";
			}
		}
		else{

		}

		return $ret."\n\r";
	}

	public function bansHandling(){
		$ret = "=== Bans Handling === \n\r";

		$userData = Usercredit::selectAllUserWithBanableCreditCount()->get();

		if(!empty($userData)){
			foreach($userData as $k =>$v){
				$user_id = $v->user_id;
				Banlist::insertBan($user_id, 1, "reached the credits bottom border (".GlobalSetting::getBanCreditBorder().")");
				Usercredit::resetUsercredits($user_id);
				$ret .= "banned user: ".$user_id." \n\r";

			}
		}
		else{
			$ret .= "usercreditsArray is empty \n\r";
		}

		return $ret."\n\r";
	}

	public function updateVoteCounts(){
		$ret = "=== Update VoteCounts === \n\r";

		// aktuelles Datum auslesen und ob heute wieder der 1 Wochentag ist
		$datum = date("N");
		//dd($datum);
		// Wenn es Monatg ist
		if($datum == GlobalSetting::getWeeklyVoteCountUpdateDay()){
			$lastUpdate = Uservotecount::getLastUpdate();
			
			$timestamp = strtotime(date("m.d.y"));
			$date = new DateTime;
			$date->setTimestamp($timestamp);
			
			if($lastUpdate != $date->format("Y-m-d H:i:s")){
				// für alle DB updaten
				Uservotecount::resetAllCounts();
				$ret .= "All UservoteCounts resetted to ".GlobalSetting::getWeeklyUpvoteCount()."-".GlobalSetting::getWeeklyDownvoteCount()."\n\r";
			}
			else{
				$ret .= "already updated \n\r";
			}
			
		}
		else{
			$ret .= "not getWeeklyVoteCountUpdateDay (".GlobalSetting::getWeeklyVoteCountUpdateDay().")\n\r";
		}

		return $ret."\n\r";
	}

	public function permabanActiveBansHandling(){
		$ret = "=== Permabans because of too many active bans handling === \n\r";
		$banData = Banlist::getAllUsersWhoHaveToMuchActiveBans()->get();
		// 	$queries = DB::getQueryLog();
		 // dd($queries);
		if(!empty($banData)){
			// if found -> permaban
			foreach ($banData as $key => $b) {
				$user_id = $b->user_id;

				$insertArray = array(
					"user_id" => $user_id,
					"banlistreason_id" => 3,
					"banned_at" => new DateTime,
					);
				Permaban::insert($insertArray);
				$ret .= "User: ".$user_id." got permabanned";
			}
		}
		return $ret."\n\r";
	}

	public function activeBansDecayHandling(){
		$ret = "=== Active Bans Decay handling === \n\r";
		$timeDecay = GlobalSetting::getBanDecayTime(); // 20 Days
		$banData = Banlist::getAllUsersThatHaveOldActiveBans($timeDecay)->get();
// $queries = DB::getQueryLog();
// dd($queries);
		if(!empty($banData)){
			// if found -> permaban
			foreach ($banData as $key => $b) {
				
				$id = $b->id;
				$user_id = $b->user_id;	

				$updateArray = array(
					"id" => $id,
					"display" => 0,
					"updated_at" => new DateTime,
					);
				Banlist::where("id", $id)->update($updateArray);
				$ret .= "Users ".$user_id." ban got deactivated";
			}
		}
		return $ret."\n\r";
	}
}
