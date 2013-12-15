<?php

class MatchmakingController extends BaseController {

	public function cleanUpFailedQueue(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$match_id = Input::get("match_id");
				$reason = Input::get("reason");

				$ret = array();
                $ret['debug'] = "Start cleanUpFailedQueue <br>\n";
                // clean Queue
                $retKAPOFQ = GameQueue::kickAllUsersOutOfQueue($match_id);

                // clean DBMM
                $retMM = Matched_user::cleanMatchedUsers($match_id);

                
                // clean MatchDetails
                $retMD = Matchdetail::deleteMatchdetails($match_id);
                
                // clean created Match
                $retM = Match::deleteCreatedMatch($match_id);

                
                // clean Host of Match
                $retHFM = Matchhost::deleteHost($match_id);

                
                // prio Queue resetten für bestimmte faelle
                switch($reason){
                        case "declined":
                        case "autoKick":
                                // TODO
                        		//$_SESSION['user']['joinTimestamp'] = 0;
                                break;
                }
                //$ret['session'] = p($_SESSION,1);
                $ret['status'] = true;

                $ret['debug'] .= "End cleanUpFailedQueue <br>\n";
                return $ret;
			}
		}
	}

	public function acceptMatch(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$user_id = Auth::user()->id;
				Matched_user::setReadyForUser($user_id);

				$ret['status'] = true;
			}
		}
		return $ret;
	}

	public function checkAllReadyForMatch(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$match_id = Input::get("match_id");
				$count = Matched_user::getReadyCount($match_id);
				$ret['countReady'] = (int) $count;
				$ret['status'] = true;
			}
		}
		return $ret;
	}
}
