<?php

class Team extends Eloquent {
	protected $guarded = array();
	protected $table = "teams";

	public static $rules = array(
		'name' => 'required'
	);

	public static function getTeamsAsArray(){
		$ret = DB::table("teams")->get();
		if(!empty($ret)){
			$teamArray = array();
			foreach ($ret as $key => $team) {
				$teamArray[$team->id] = $team->name;
			}
			return $teamArray;
		}
		else{
			return null;
		}
	}
}
