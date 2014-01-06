<?php

class Matchvote extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'match_id' => 'required',
		'vote_for_user' => 'required',
		'matchvotetype_id' => 'required',
		'reason' => 'required'
	);


	public static function insertCancelVote($match_id, $user_id){
		$insertArray = array(
			"user_id" => $user_id,
			"match_id" => $match_id,
			"vote_for_user" => 0,
			"matchvotetype_id" => 1,
			"created_at" => new DateTime(),
			);
		Matchvote::insert($insertArray);
	}

	public static function insertLeaverVote($match_id, $user_id, $vote_for_user){
		$insertArray = array(
			"user_id" => $user_id,
			"match_id" => $match_id,
			"vote_for_user" => $vote_for_user,
			"matchvotetype_id" => 2,
			);
		Matchvote::insert($insertArray);
	}	

	public static function getAllLeaverVotesForUser($match_id, $user_id){
		return Matchvote::where("matchvotetype_id", 2)
					->where("match_id", $match_id)
					->where("vote_for_user", $user_id);
	}

	public static function getAllLeaverVotesCountsForMatch($match_id){
		return Matchvote::where("matchvotetype_id", 2)
					->where("match_id", $match_id)
					->groupBy("vote_for_user")
					->select("vote_for_user",
						DB::raw("COUNT(vote_for_user) as leaverVotes"));
	}
}
