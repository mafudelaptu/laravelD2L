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

	// public function user(){
	// 	return $this->belongsTo("User");
	// }
}
