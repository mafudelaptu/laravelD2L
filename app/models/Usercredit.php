<?php

class Usercredit extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = "usercredits";

	public static function getCreditCount($user_id){
		$ret = array();
		if($user_id > 0){

			$sum = DB::table("usercredits")->where("user_id", $user_id)->sum("vote");

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
}
