<?php

class Matchhost extends Eloquent {
	protected $guarded = array();
	protected $table = 'matchhosts';
	public static $rules = array();

	public $timestamps = false;

	public static function deleteHost($match_id){
		return DB::table("matchhosts")->where("match_id", $match_id)
						->delete();
	}
}
