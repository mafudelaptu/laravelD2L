<?php

class CronjobMatchmakingController extends BaseController {

	public function doMatchmaking(){
		$ret = "";

		/*
		 * Check if someone left site without leaving the Queue
		*/
		GameQueue::deleteAFKUsers();

		$matchtypes = Matchtype::getAllActiveMatchtypes()->orderBy(DB::raw('RAND()'))->get();
		$modes = Matchmode::getAllActiveModes()->orderBy(DB::raw('RAND()'))->get();
		$regions = Region::getAllActiveRegions()->orderBy(DB::raw('RAND()'))->get();

		if(!empty($matchtypes)){
			foreach ($matchtypes as $key => $matchtype) {
				if(!empty($modes)){
					foreach ($modes as $key => $matchmode) {
						if(!empty($regions)){
							foreach ($regions as $key => $region) {
								$matchtype_id = $matchtype->id;
								$matchmode_id = $matchmode->id;
								$region_id = $region->id;
								$playercount = $matchtype->playercount;
								$ret .= "MT:".$matchtype_id." MM:".$matchmode_id." R:".$region_id." PC:".$playercount." ";
								$ret .= $this->searchForMatchingUsersInQueue($matchtype_id, $matchmode_id, $region_id, $playercount);
								$ret .= "\r\n";						
							}
						}
					}
				}
			}
		}

		return $ret;
	}

	public function searchForMatchingUsersInQueue($matchtype_id, $matchmode_id, $region_id, $playercount){
		$ret = "";
		$nochWelcheInQueue = true;
		while($nochWelcheInQueue){
			for($i=0; $i<2; $i++){
				for($j=1; $j<=3; $j++){
					$retCount = $this->getUserCountsInQueue($matchmode_id, $matchtype_id, $region_id, $i, $j, $playercount);
					if(!$retCount['status']){
						$nochWelcheInQueue = false;
						$ret .= "nope(".$retCount['debug'].")!";
					}
					else{
						$ret .= "gefunden!";
					}
				}
			}
		}
		return $ret;
	}

	public function getUserCountsInQueue($matchmode_id, $matchtype_id, $region_id, $force, $skillbracket, $playercount){
		$ret = array();
		( $force==1 ? $force = "true" : $force="false" );
		$usersData = GameQueue::getQueueCounts($matchmode_id, $matchtype_id, $region_id, $force, $skillbracket, false)->take($playercount);
		$count = $usersData->count();
		$users = $usersData->get();
		$ret['debug'] = $count;
		if($count == $playercount){
			// delete User out of Queue
			$usersData->delete();

			// create Match
			$match_id = Match::createNewMatch($matchtype_id, $matchmode_id, $region_id);

			// found users insert into matched_users
			$matchedUsersArray = Matched_user::insertUsers($users, (int)($playercount/2));

			// create Matchdetails
			Matchdetail::addDetailsToMatch($match_id, $matchedUsersArray);

			$ret['status'] = true;
		}
		else{
			$ret['status'] = false;
		}
		return $ret;
	}
}
