<?php

class CronjobDoAllController extends BaseController {

	public function doAllCronjobs(){
		$ret = "";
		// Match result handling
		$ret .= $this->matchResultHandling();

		return $ret;
	}

	public function matchResultHandling(){
		$ret = "";

		$openMatches = Match::getAllOpenMatches()->get();
		if(!empty($openMatches)){
			foreach ($openMatches as $key => $match) {
				$match_id = $match->id;
				$matchmode_id = $match->matchmode_id;
				$matchtype_id = $match->matchtype_id;

				$submittedCount = Matchdetail::getSubmittedMatchdetails($match_id)->count();
				switch ($matchtype_id) {
					case 2: // 1vs1
						# code...
					break;
					
					default: // 5vs5
					if($submittedCount >= 8){
						$matchdetailsData = Matchdetail::getMatchdetailData($match_id, false, false)->orderBy("matchdetails.points")
						->select("matchdetails.*")
						->get();
						
						$matchPlayersData = Match::getPlayersData($matchdetailsData, $matchtype_id);

						$check = $this->checkSubmissions($matchdetailsData);

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

	public function checkSubmissions($matchdetails){
		$ret = array();

		if(!empty($matchdetails)){
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
		}
		else{
			$ret['status'] = "matchdetails empty";
		}

		return $ret;
	}
}
