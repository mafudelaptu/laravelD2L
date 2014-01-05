<?php

class Banlist extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'banned_at' => 'required',
		'banned_until' => 'required',
		'banlistreason_id' => 'required',
		'display' => 'required',
		'bannedBy' => 'required',
		'reason' => 'required'
	);

	public static function checkForBansOfUser($user_id){
		$ret = array();
		$data = Banlist::where("user_id", $user_id)
		->where("display", 1)
		->where("banned_until", ">", new DateTime)
		->orderBy("banned_until", "DESC");

		$count = $data->count();

		if($count > 0){
			$ret['data'] = $data->take(1);
			$ret['banCount'] = $count;
			$ret['status'] = true;
		}
		else{
			$ret['status'] = false;
		}

		return $ret;
	}

	public static function getAllActiveBans($user_id){
		if($user_id > 0){
			$data = DB::table("banlists")->where("user_id", $user_id)
								->where("display", 1);
			
			return $data;
		}
		else{
			return  "user_id == 0";
		}
	}

	public static function getAllBans($user_id){
		if($user_id > 0){
			$data = DB::table("banlists")->where("user_id", $user_id);
			
			return $data;
		}
		else{
			return  "user_id == 0";
		}
	}
}
