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
		->where("banned_till", ">", new DateTime)
		->orderBy("banned_till", "DESC");

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

}
