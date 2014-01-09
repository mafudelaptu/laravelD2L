<?php

class Eventtype extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'matchmode_id' => 'required',
		'matchtype_id' => 'required',
		'tournamenttype_id' => 'required',
		'description' => 'required',
		'min_submissions' => 'required',
		'start_time' => 'required',
		'start_day' => 'required',
		'region_id' => 'required',
		'active' => 'required',
		'prizetype_id' => 'required',
		'eventrequirement_id' => 'required'
	);
}
