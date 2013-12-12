<?php

class Region extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'active' => 'required'
	);

	public function users(){
		return $this->hasMany("User");
	}

	public static function getAllActiveRegions(){
		return Region::where("active", 1)->remember(60);
	}
}
