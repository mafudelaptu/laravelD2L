<?php

class GameQueuesController extends BaseController {

	public function checkJoinQueue(){
		if(Auth::check()){
			if (Request::ajax()){
				$ret = array();
				$user_id = Auth::user()->id;
				$type = Input::get("type");
				// leave Queue before, so u cant double queue
				$this->leaveQueue();

				// check Queue Join, allowed to join etc?
				$retQL = QueueLock::checkLock($user_id);
				if($retQL['status'] == true){
					// check if banned?
					$permabanned = PermaBan::isUserPermaBanned($user_id);
					if(!$permabanned){
						$retBL = Banlist::checkForBansOfUser($user_id);
						if($retBL['status'] == false){
							$inMatch = Match::isUserInMatch($user_id);
							if($inMatch['status'] == true){
								$ret['status'] = "inMatch";
							}
							else{
								$ret['status'] = true;
							}
						}
						else{
							$ret['banCount'] = $retBL['banCount'];
							$ret['data'] = $retBL['data'];
							$ret['status'] = "banned";
						}
					}
					else{
						$ret['status'] = "permaBanned";
					}
				}
				else{
					$ret['time'] = $retQL['time'];
					$ret['status'] = "queueLock";
				}
				return $ret;
			}
		}
		else{
			return false;
		}
		
	}

	public function leaveQueue(){
		$user_id = Auth::user()->id;
		$ret = array();
		$retDel = GameQueue::deleteUserOutOfQueue($user_id);

		Session::forget("queueJoinTimestamp");
		$ret['status'] = $retDel;
		return $ret;
	}

	public static function joinQueue(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$ret = array();
				$modes = Input::get("modes");
				$region_id = Auth::user()->region->id;
				$matchtype_id = Input::get("matchtype_id");
				$user_id = Auth::user()->id;
				$inMatch = Match::isUserInMatch($user_id);

				if(!$inMatch){
					// get Points of user
					$points = Userpoint::getPoints($user_id);
					
					if(is_array($modes)){
						$insertArray = array();
						foreach ($modes as $k => $mode) {
							$mode_id = (int) $mode['id'];
							$tmp = array();
							$tmp['user_id'] = $user_id;
							$tmp['matchtype_id'] = $matchtype_id;
							$tmp['matchmode_id'] = $mode_id;
							$tmp['rank'] = $points;
							$tmp['created_at'] = new DateTime;
							$tmp['updated_at'] = new DateTime;
							$tmp['region_id'] = $region_id;
							$tmp['force_search'] = 0;
							$insertArray[] = $tmp;
						}
						
						DB::table('queues')->insert($insertArray);
						$ret['status'] = true;
					}	
				}
				else{
					$ret['status'] = false;
				}
				
			}
		}
		else{
			$ret['status'] = false;
		}
		return $ret;
	}

	public function doMatchmaking(){
		$ret = array ();
		$user_id = Auth::user()->id;
		$region = Auth::user()->region_id;
		$matchtype_id = Input::get("matchtype_id", 1);
		$forceSearch = Input::get("forceSearch",false);
		$modes = Input::get("modes");

                // update Queue timestamps
		GameQueue::updateQueueTime($user_id);

                // update ForceSearch
		GameQueue::updateForceSearch($user_id, $forceSearch);

                // checken ob bereits in MatchTeams

		$alreadyMatched = Matched_user::alreadyMatched($user_id);
		$ret['alreadyMatched'] = $alreadyMatched;

		$skillbracketData = Userskillbracket::getSkillbracket($user_id, $matchtype_id, true)->get();
		$skillbracketData = $skillbracketData[0];

		$skillbracket_id = $skillbracketData->skillbrackettype_id;
		$skillbracket_name = $skillbracketData->name;
		if ($forceSearch == "true" && $skillbracket_id != "1") {
			$skillBracket = "Force";
		} else {
			switch ($skillbracket_id) {
				case 1 :
				case 2 :
				$skillBracket = $skillbracket_name;
				break;
				default :
				$skillBracket = "Amateur or higher";
				break;
			}
		}

		$ret ['skillBracket'] = $skillBracket;

                // Queue Stats
		$retSBQC = GameQueue::getSkillbracketQueueCounts($matchtype_id);
		//var_dump($retSBQC);
		$ret['queueCounts'] = $retSBQC['data'];

		$retSingle = GameQueue::getPlayersQueueCounts ( $user_id, $modes, $region, $skillbracket_id, $forceSearch, $matchtype_id );
		//var_dump($retSingle);
		$ret['queue'] = $retSingle['data'];
		if ($alreadyMatched === true) {
			$userData = Matched_user::getMatchedUserData($user_id)->first();
			$ret['match_id'] = $userData->match_id;
			$ret ['status'] = "finished";
		} else {
            // checken ob User noch in Queue
			$inQueue = GameQueue::inQueue($user_id);
			if(!$inQueue){
				$ret['status'] = "notInQueue";
			}
			else{
				$ret ['status'] = "searching";
			}

		}

                // seconds till next matchmaking
		$cur_secs = date ( "s" );
		$left_sec = 60 - $cur_secs;
		$ret ['nextMatchmaking'] = ( int ) $left_sec;

		return $ret;
	}

	public function insertRandomUserIntoQueue(){
		$ret = array();

		$matchtype_id = Input::get("matchtype_id");

		$user = User::getRandomUser();
		$user = $user[0];
		$user_id = $user->id;

		// set skillbracket
		$retSB = Userskillbracket::setSkillbrackets($user_id);

		// get points
		$points = Userpoint::getPoints($user_id);

		$matchmodes = MatchMode::getAllActiveModes()->get();
		// general Settings
		$region_id = 1;
		$force = 0;
		if(!GameQueue::inQueue($user_id)){
			if(!empty($matchmodes)){
				foreach($matchmodes as $mode){

					$matchmode_id = $mode->id;
					GameQueue::insertInQueue($user_id, $matchtype_id, $matchmode_id, $region_id, $points, $force);
				}
				$ret['status'] = "true";
			}
			else{
				$ret['status'] = "matchmodes null";
			}
		}
		else{
			$ret['status'] = "already in Queue";
		}
		return $ret;
	}

	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('queues.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('queues.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('queues.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('queues.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
