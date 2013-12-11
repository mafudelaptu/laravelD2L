<?php

class CronjobMatchmakingController extends BaseController {

	public function doMatchmaking(){

		/*
		 * Check if someone left site without leaving the Queue
		*/
		GameQueue::deleteAFKUsers();

		$matchtypes = Matchtype::getAllActiveMatchtypes()->order_by(DB::raw('RAND()'))->get();
		$modes = Matchmode::getAllActiveModes()->order_by(DB::raw('RAND()'))->get();
		$regions = Region::getAllActiveRegions()->order_by(DB::raw('RAND()'))->get();

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

								$this->searchForMatchingUsersInQueue($matchtype_id, $matchmode_id, $region_id, $playercount);						
							}
						}
					}
				}
			}
		}

		return true;
	}

	public function searchForMatchingUsersInQueue($matchtype_id, $matchmode_id, $region_id, $playercount){
		$nochWelcheInQueue = true;
		while($nochWelcheInQueue){
			for($i=0; $i<2; $i++){
				for($j=1; $j<=3; $j++){
					$retCount = $this->getUserCountsInQueue($matchmode_id, $matchtype_id, $region_id, $i, $j, $playercount);
					if(!$retCount){
						$nochWelcheInQueue = false;
					}
				}
			}
		}
	}

	public function getUserCountsInQueue($matchmode_id, $matchtype_id, $region_id, $force, $skillbracket, $playercount){
		( $force==1 ? $force = "true" : $force="false" );
		$usersData = GameQueue::getQueueCounts($matchmode_id, $matchtype_id, $region_id, $force, $skillbracket, false)->take($playercount);
		$count = $usersData->count();
		$users = $usersData->get();

		if($count == $playercount){
			// delete User out of Queue
			$usersData->delete();

			// create Match
			$match_id = Match::createNewMatch($matchtype_id, $matchmode_id, $region_id);

			// found users insert into matched_users
			$matchedUsersArray = Matched_user::insertUsers($users, (int)($playercount/2));

			// create Matchdetails
			Matchdetail::addDetailsToMatch($match_id, $matchedUsersArray);

			return true;
		}
		else{
			return false;
		}
	}
}

