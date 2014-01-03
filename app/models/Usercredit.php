<?php

class Usercredit extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = "usercredits";

	public static function getCreditCount($user_id){
		$ret = array();
		if($user_id > 0){

			$sum = DB::table("usercredits")->where("user_id", $user_id)
						->sum("vote");

			if($sum > 0){
				return $sum;

			}
			else{
				return 0;
			}
		}
		else{
			return "user_id = 0";
		}
	}

	public static function insertCredit($user_id, $voted_by_user_id, $vote, $match_id){
		$insertArray = array(
			"user_id" => $user_id,
			"voted_by_user_id" => $voted_by_user_id,
			"vote" => $vote,
			"match_id" => $match_id,
			"created_at" => new DateTime(),
			"updated_at" => new DateTime(),
			);
		Usercredit::insert($insertArray);
	}
}
