<?php

class Matchdetail extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = "matchdetails";
	public $timestamps = false;

	public static function deleteMatchdetails($match_id){
		return DB::table("matchdetails")->where("match_id", $match_id)
			->delete();
	}
}
