<?php

class CronjobDoAllController extends BaseController {

	public function doAllCronjobs(){
		$ret = "";

		// cancel Matches
		$ret .= $this->cancelMatchHandling();
		
		// uservotes handling
		$ret .= $this->uservotesHandling();

		// Match result handling
		$ret .= $this->matchResultHandling();

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
		return $ret;
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
		
	}
}
