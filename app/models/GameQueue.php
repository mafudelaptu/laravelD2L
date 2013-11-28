<?php

class GameQueue extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'queues';

	public static function getAllUsersInQueueByRegion($region_id){
		return GameQueue::where("region_id", $region_id);
	}

	public static function getPlayersInQueue($matchtypeID){
		//return $matchtype_id;
		return GameQueue::where("matchtype_id", $matchtypeID);
	}

	public function matchmode(){
		return $this->belongsTo("Matchmode", "id");
	}

	public static function deleteUserOutOfQueue($user_id){
		$affectedRows = GameQueue::where('user_id', $user_id)->delete();
		return true;
	}

	public static function updateQueueTime($user_id){
		$retIns = DB::table('queues')
            ->where('user_id', $user_id)
            ->update(array('updated_at' => new DateTime));
		return $retIns;
	}

	public static function updateForceSearch($user_id, $force_search){
		$retUpd = DB::table('queues')
            ->where('user_id', $user_id)
            ->update(array('force_search' => $force_search));
		return $retUpd;
	}

	public static function getSkillbracketQueueCounts($matchtype_id){
		$ret = array();
                $ret ['debug'] = "Start getSkillBracketQueueCounts <br>\n";
                // Skill Bracket Count
                $sbdata = DB::table("queueus")->join('userskillbrackets', function($join)
        {
            $join->on('queues.user_id', '=', 'userskillbrackets.user_id')->on("userskillbrackets.matchtype_id", "=", $matchtype_id);
        })->where("queueus.force_search", 0)->get();

                $retData = array (
                                -1 => 0,
                                1 => 0,
                                2 => 0,
                                3 => 0
                );
                if (!empty($sbdata) {
                        foreach ( $sbdata as $k => $v ) {
                                $skillBracket = $v->skillbrackettype_id;
                                if($skillBRacket >= 3){
                                        $skillBRacket = 3;
                                }
                                $retData [$skillBRacket] ++;
                        }
                }

                // Force Search Count
                $sql = "SELECT q.SteamID
                                FROM `Queue` q
                                WHERE ForceSearch = 1 AND q.MatchTypeID = ".(int) $matchTypeID."
                                GROUP BY q.SteamID
                                ";
                $data3 = $DB->multiSelect ( $sql );
                $ret ['debug'] .= p ( $sql, 1 );

                $fsData = DB::table("queueus")->where("force_search", 1)
                							->where("matchtype_id", $matchtype_id)
                							->groupBy("user_id")->get();

                if (!empty($fsData)) {
                        foreach ( $fsData as $k => $v ) {
                                $retData [-1] ++;
                        }
                }

                $ret ['data'] = $retData;
                $ret ['status'] = true;

                $ret ['debug'] .= "End getSkillBracketQueueCounts <br>\n";
		return $ret;
	}

	public static function getPlayersQueueCounts($$user_id, $modes, $region, $userSkillBRacketTypeID, $forceSearch, $matchtype_id){
		$ret = array();
                $ret ['debug'] = "- Start getPlayerCountsOfQueueSkillBracket - \n\n";
                $ret ['foundPlayersSQL'] = array ();
                $ret ['foundPlayersData'] = array ();

                // $_SESSION['erweiterteSuche'] = array("6");
                // $ret .= "rangeArray: ".print_r($rangeArray,1)." \n\n";
                if (!empty($modes)) {
                        if ($region > 0) {
                                foreach ( $modes as $k => $modus ) {
                                        $countArray = array ();
                                        $posiArray = array ();

                                                $retC = $this->getQueueCountsSkillBracket ( $modus, $matchTypeID, $region, $forceSearch, $userSkillBracketTypeID );
                                                $ret ['debug'] .= p ( $retC, 1 );
                                                $count = $retC ['count'];
                                                $data = $retC ['data'];
                                                $data2 = $retC ['data2'];
                                                // arrays Mergen
                                                $globalArray = array ();
                                                if ((is_array ( $data2 ) && count ( $data2 ) > 0) && (is_array ( $data ) && count ( $data ) > 0)) {
                                                        $globalArray = array_merge ( $data, $data2 );
                                                } else if (is_array ( $data ) && count ( $data ) > 0) {
                                                        $globalArray = $data;
                                                } else if (is_array ( $data2 ) && count ( $data2 ) > 0) {
                                                        $globalArray = $data2;
                                                }

                                                $ret ['debug'] .= "+++++++++++++++++ GLOBAL ARRAY:" . p ( $globalArray, 1 );

                                                $posi = "";
                                                if (is_array ( $globalArray ) && count ( $globalArray ) > 0) {
                                                        // nach Timstamp sortieren und position hausfinden
                                                        $globalArray = orderArrayBy ( $globalArray, 'Timestamp', SORT_ASC );
                                                        $ret ['debug'] .= "+++++++++++++++++ GLOBAL ARRAY:" . p ( $globalArray, 1 );
                                                        $posi = recursive_array_search ( $steamID, $globalArray );
                                                        $posiArray [] = ( int ) $posi + 1;
                                                }

                                                $countArray [] = $count;

                                                // matchDetails
                                                $ret ['matchDetails'] .= "<p>" . date ( 'H:i:s' ) . " - " . "Searching in MatchMode: " . $modus . " witch following ranges: " . $untere_grenze . " - " . $obere_grenze . " Players found: " . $count . "</p>";
                                        

                                        $ret ['debug'] .= "+++++++++++++++++ COUNT:" . p ( $countArray, 1 );
                                        $ret ['debug'] .= "+++++++++++++++++ PosiArray:" . p ( $posiArray, 1 );

                                        // herausbekommen was der größte Wert zurzeit ist
                                        if (is_array ( $countArray ) && count ( $countArray ) > 0 && is_array ( $posiArray ) && count ( $posiArray ) > 0) {
                                                $max = max ( $countArray );
                                                $maxPosi = max ( $posiArray );
                                                $ret ['debug'] .= p ( "WIRD IN SESSION EINGETRAGEN: :" . "C:" . $max . " P:" . $maxPosi, 1 );

                                                $_SESSION ['queue'] [$modus] ['count'] = ( int ) $max;
                                                $_SESSION ['queue'] [$modus] ['position'] = ( int ) $maxPosi;
                                        } else {
                                                $ret ['debug'] .= p ( "irgend ein Array ist NULL", 1 );
                                                $_SESSION ['queue'] [$modus] ['count'] = ( int ) 1;
                                                $_SESSION ['queue'] [$modus] ['position'] = ( int ) 1;
                                        }
                                } // END MODUS FOREACH
                        }
                }
                $ret ['debug'] .= p ( $_SESSION, 1 );
                $ret ['debug'] .= "- END getPlayerCountsOfQueueSkillBracket - \n\n";
                return $ret;
	}

	public static function getQueueCounts($modus, $matchTypeID, $region, $forceSearch, $userSkillBracketTypeID){

	$ret = array ();
                $ret ['debug'] = "Start getQueueCountsSkillBracket <br>\n";

                
                $data = DB::table("queues")->join('userskillbrackets', function($join){
								            $join->on('queues.user_id', '=', 'userskillbrackets.user_id')->on("userskillbrackets.matchtype_id", "=", $matchtype_id);
								        })->where("region_id", $region)
                						->where("matchmode_id", $modus)
                						->where("matchtype_id", $matchtype_id);
                // Wenn force Search, dann auch nur force Search Leute suchen
                $skillBracketSQL = "";
                if ($forceSearch == "true") {
                        $data = $data->where("force_search", 1);
                } else {
                        $data = $data->where("force_search", 0);
                        switch ($userSkillBracketTypeID) {
                                case 1 :
                                        $data = $data->where("skillbrackettype_id", 1);
                                        break;
                                case 2 :
                                        $data = $data->where("skillbrackettype_id", 2);
                                        break;
                                default :
                                		$data = $data->where("skillbrackettype_id", ">=" 3);
                        }
                }

                $data = $data->orderBy('created_at', 'asc');
				$count = $data->count();

                $ret ['count'] = $count;
                $ret ['data'] = $data;
                $ret ['debug'] .= "End getQueueCountsSkillBracket <br>\n";
                return $ret;
	}
	// public function user(){
	// 	return $this->belongsTo("User");
	// }
}
