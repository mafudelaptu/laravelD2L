<?php

class GameQueue extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'queues';

	public static function getAllUsersInQueueByRegion($region_id){
		return GameQueue::where("region_id", $region_id)->groupBy("user_id");
	}

    public static function getAllUsersInQueue(){
        return DB::table("queues");
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
      $sbdata = DB::table("queues")->join('userskillbrackets', 'queues.user_id', '=', 'userskillbrackets.user_id')
      ->where("queues.force_search", 0)
      ->where("userskillbrackets.matchtype_id", $matchtype_id)
      ->where("queues.matchtype_id", $matchtype_id)
      ->groupBy("queues.user_id")
      ->get();
      
      $retData = array (
        -1 => 0,
        1 => 0,
        2 => 0,
        3 => 0
        );
      if (!empty($sbdata)) {
        foreach ( $sbdata as $k => $v ) {
            $skillBracket = $v->skillbrackettype_id;
            if($skillBracket >= 3){
                $skillBracket = 3;
            }
            $retData [$skillBracket] ++;
        }
    }

    // Force Search Count
    $fsData = DB::table("queues")->where("force_search", 1)
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

public static function getPlayersQueueCounts($user_id, $modes, $region, $skillbrackettype_id, $forceSearch, $matchtype_id){
  $ret = array();
  $ret ['debug'] = "- Start getPlayerCountsOfQueueSkillBracket - \n\n";
  $ret ['foundPlayersSQL'] = array ();
  $ret ['foundPlayersData'] = array ();
  $ret['data'] = null;
  if (!empty($modes)) {
    if ($region > 0) {
        foreach ( $modes as $k => $modus ) {
            $countArray = array ();
            $posiArray = array ();
            $matchmode_id = $modus['id'];
            $retC = GameQueue::getQueueCounts( $matchmode_id, $matchtype_id, $region, $forceSearch, $skillbrackettype_id );

            $count = $retC ['count'];
            $data = $retC ['data'];
            //var_dump($data);
            $posi = 0;
            if (is_array ( $data ) && count ( $data ) > 0) {
                // nach Timstamp sortieren und position hausfinden
                $posi = General::recursive_array_search ( $user_id, $data );
                $posi = ( int ) $posi + 1;
            }

            // herausbekommen was der größte Wert zurzeit ist
            if ($count > 0 && $posi > 0) {
                $ret['data'][$matchmode_id] ['count'] = ( int ) $count;
                $ret['data'][$matchmode_id] ['position'] = ( int ) $posi;
            } else {
                $ret['data'][$matchmode_id] ['count'] = ( int ) -1;
                $ret['data'][$matchmode_id] ['position'] = ( int ) -1;
            }
            } // END MODUS FOREACH
        }
    }
    
    $ret ['debug'] .= "- END getPlayerCountsOfQueueSkillBracket - \n\n";
    return $ret;

}

public static function getQueueCounts($matchmode_id, $matchtype_id, $region, $forceSearch, $skillbrackettype_id, $returnAjax = true){
 $ret = array ();
 $ret ['debug'] = "Start getQueueCountsSkillBracket <br>\n";


 $data = DB::table("queues")->join('userskillbrackets', 'queues.user_id', '=', 'userskillbrackets.user_id')
 ->where("userskillbrackets.matchtype_id", $matchtype_id)
 ->where("queues.region_id", $region)
 ->where("queues.matchmode_id", $matchmode_id)
 ->where("queues.matchtype_id", $matchtype_id);
                // Wenn force Search, dann auch nur force Search Leute suchen
 $skillBracketSQL = "";
 if ($forceSearch == "true") {
    $data = $data->where("force_search", 1);
} else {
    $data = $data->where("force_search", 0);
    switch ($skillbrackettype_id) {
        case 1 :
        $data = $data->where("skillbrackettype_id", 1);
        break;
        case 2 :
        $data = $data->where("skillbrackettype_id", 2);
        break;
        default :
        $data = $data->where("skillbrackettype_id", ">=", 3);
    }
}

$data = $data->orderBy('queues.created_at', 'asc');
if($returnAjax){
    $count = $data->count();

$ret ['count'] = $count;
$ret ['data'] = $data->get();
$ret ['debug'] .= "End getQueueCountsSkillBracket <br>\n";
    return $ret;    
}
else{
    return $data;
}
}

public static function inQueue($user_id){
    $userCount = GameQueue::where("user_id", $user_id)->count();

    if($userCount > 0){
        return true;
    }
    else{
        return false;
    }
}

public static function insertInQueue($user_id, $matchtype_id, $matchmode_id, $region_id, $points, $force=0){
        $tmp = array();
        $tmp['user_id'] = $user_id;
        $tmp['matchtype_id'] = $matchtype_id;
        $tmp['matchmode_id'] = $matchmode_id;
        $tmp['rank'] = $points;
        $tmp['created_at'] = new DateTime;
        $tmp['updated_at'] = new DateTime;
        $tmp['region_id'] = $region_id;
        $tmp['force_search'] = $force;

        DB::table('queues')->insert($tmp);
    }

	// public function user(){
	// 	return $this->belongsTo("User");
	// }

    public static function kickAllUsersOutOfQueue($match_id){
        // get all Users
        $users = Matched_user::getAllMatchedUsersByMatchID($match_id);
        if(!empty($users)){
            foreach ($users as $k => $user) {
                $user_id = $user->user_id;
                DB::table("queues")->where("user_id", $user_id)
                    ->delete();
            }
            return true;
        }
        else{
            return false;
        }
    }

    public static function deleteAFKUsers(){
        $checkTime = time()-30;

        $users = DB::table("queues")->where("updated_at", "<", date("Y-m-d H:i:s", $checkTime))->get();

        if(!empty($users)){
            foreach ($users as $k => $user) {
                // delete user
                $user_id = $user->user_id;
                $dirTest = dirname(__FILE__);
                if(strpos($dirTest, "laravelD2L") === false){
                    GameQueue::deleteUserOutOfQueue($user_id);
                }
            }
        }
    }

     public static function deleteUsers($userData){
        if(!empty($userData)){
            foreach ($userData as $k => $user) {
                // delete user
                $user_id = $user->user_id;
                GameQueue::deleteUserOutOfQueue($user_id);
            }
        }
    }

    public static function getAllMatchmodes(){
        return GameQueue::join("matchmodes", "queues.matchmode_id", "=", "matchmodes.id")->groupBy("queues.matchmode_id");
    }

    public static function getAllMatchtypes(){
        return GameQueue::join("matchtypes", "queues.matchtype_id", "=", "matchtypes.id")->groupBy("queues.matchtype_id");
    }

    public static function getAllRegions(){
        return GameQueue::join("regions", "queues.region_id", "=", "regions.id")->groupBy("queues.region_id");
    }
}
