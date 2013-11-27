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

	// public function user(){
	// 	return $this->belongsTo("User");
	// }
}
