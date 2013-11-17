<?php

class Match extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'matches';
	protected $primaryKey = 'id';

	public static function getAllMatchesPlayed(){
		return Match::where("canceled", 0)
		->where("check", 0)
		->where("team_won_id","!=",-1)
		->where("closed",">",0);
	}

	public static function getAllLiveMatches(){
		return Match::where("canceled", 0)
		->where("check", 0)
		->where("team_won_id",-1)
		->where("closed",0);
	}

	public static function getAllOpenMatches(){
		return Match::where("canceled", 0)
		->where("check", 0)
		->where("team_won_id",-1)
		->where("closed",0);
	}
}
