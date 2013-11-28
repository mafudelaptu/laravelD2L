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

		$ret = GameQueue::deleteUserOutOfQueue($user_id);

		Session::forget("queueJoinTimestamp");
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
							$mode_id = (int) $mode;
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
                $matchtype_id = Input::get("matchtype_id", 1);
                $forceSearch = Input::get("forceSearch",false);
                $modes = Input::get("modes");

                // // Range Array erstellen - workaround
                // if (is_array ( $modes ) && count ( $modes ) > 0) {
                //         $rangeArray = array ();
                //         foreach ( $modes as $k => $modus ) {
                //                 // Count von gefundenen Spielern auf 1 setzen
                //                 $_SESSION ['queue'] [$modus] ['count'] = "1";
                //                 $_SESSION ['queue'] [$modus] ['position'] = "1";

                //                 // Anfangsrange setzen = aktueller Elo
                //                 if ($_SESSION ['points'] >= Matchmaking::maxEloRange) {
                //                         $rangeArray [$modus] ['obere_grenze'] = $_SESSION ['points'] [$modus] + Matchmaking::maxEloRange;
                //                         $rangeArray [$modus] ['untere_grenze'] = $_SESSION ['points'] [$modus] - Matchmaking::maxEloRange;
                //                 } else {
                //                         $rangeArray [$modus] ['obere_grenze'] = $_SESSION ['points'] [$modus] + Matchmaking::maxEloRange;
                //                         $rangeArray [$modus] ['untere_grenze'] = 0;
                //                 }
                //         }
                // }
                GameQueue::updateQueueTime($user_id);

                // update ForceSearch
                GameQueue::updateForceSearch($user_id, $forceSearch);

                // checken ob bereits in MatchTeams

                $alreadyMatched = Matched_user::alreadyMatched($user_id);
				$ret['alreadyMatched'] = $alreadyMatched;

                $skillbracketData = Userskillbracket::getSkillbracket($user_id, $matchtype_id)->get();
                $skillbracket_id = $skillbracketData->skillbracket_id;
                $skillbracket_name = $skillbracketData->name;
                if ($forceSearch == "true" && $skillbracket_id != "1") {
                        $skillBracket = "Force";
                } else {
                        switch ($userSkillBRacketTypeID) {
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

                $retSBQC = Userskillbracket::getSkillbracketQueueCounts($matchtype_id);
                $ret['queueCounts'] = $retSBQC['data'];

                $retSingle = Userskillbracket::getQueueCounts ( $user_id, $modes, $region, $skillbracket_id, $forceSearch, $matchtype_id );

                $matchDetails .= $retSingle ['matchDetails'];


        
               	
                // checken ob schon durch vronjob gefunden wurde
                $sql = "SELECT DISTINCT mt.MatchID
                                From `MatchTeams` mt JOIN `Match` m ON m.MatchID = mt.MatchID
                                JOIN `MatchDetails` md ON m.MatchID = md.MatchID AND mt.SteamID = md.SteamID
                                WHERE mt.SteamID = " . secureNumber ( $steamID ) . "
                                                AND m.TeamWonID = -1 AND TimestampClosed = 0 AND Canceled = 0 AND ManuallyCheck = 0 AND mt.Ready = 0
                                                AND md.Submitted = 0 AND md.SubmissionFor = 0 AND md.SubmissionTimestamp = 0 AND EloChange = ''
                                                ORDER BY mt.MatchID DESC
                                                LIMIT 1";

                $matchID = $DB->select ( $sql );

                $matchID = ( int ) $matchID ['MatchID'];
                $matchID2 = ( int ) $retMatchID ['MatchID'];
                $retTest .= "##MATCHID##:" . $matchID . "|" . $matchID2;
                // p($count);
                // wenn match bereits gefunden durch andere User gefudnen

                if ($matchID > 0 || $matchID2 > 0) {

                        $log = new KLogger ( "log.txt", KLogger::INFO );
                        $log->LogInfo ( "Durch anderen Spieler gefunden! MatchID=" . ( int ) $matchID . "|" . ( int ) $matchID2 . "! ID der dieses Verfahren bekommt: " . $steamID ); // Prints to the log file

                        $ret ['queue'] = $_SESSION ['queue'];
                        $ret ['range'] = $_SESSION ['range'];
                        $ret ['erweiterteSuche'] = $_SESSION ['erweiterteSuche'];
                        unset ( $_SESSION ['queue'] );
                        unset ( $_SESSION ['erweiterteSuche'] );
                        unset ( $_SESSION ['range'] );
                        $ret ['test'] = $retTest;

                        if ($matchID >= $matchID2) {
                                $ret ['matchID'] = $matchID;
                                $log->LogInfo ( "MatchID=" . ( int ) $matchID . " weitergereicht - " . $steamID ); // Prints to the log file
                        } else {
                                $log->LogInfo ( "MatchID2=" . ( int ) $matchID2 . " weitergereicht - " . $steamID ); // Prints to the log file
                                $ret ['matchID'] = $matchID2;
                        }
                        $ret ['status'] = "finished";
                } else {
                        // checken ob User noch in Queue
                        $inQueue = $Queue->inQueue();
                        if(!$inQueue){
                                $ret['status'] = "notInQueue";
                        }
                        else{
                                $ret ['status'] = "searching";
                        }
                        
                }
                // $retTest .= $retWideRange;
                $ret ['retWideRange'] = $retWideRange;
                $ret ['test'] = $retTest . "\n\n\n####################\n";
                $ret ['queue'] = $_SESSION ['queue'];
                $ret ['range'] = $rangeArray;
                $ret ['erweiterteSuche'] = $_SESSION ['erweiterteSuche'];

                $ret ['matchDetails'] = $matchDetails . $retWideRange;

                // seconds till next matchmaking
                $cur_secs = date ( "s" );
                $left_sec = 60 - $cur_secs;
                $ret ['nextMatchmaking'] = ( int ) $left_sec;

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
