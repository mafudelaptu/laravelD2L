<?php

class Skillbrackettype extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'winpoints' => 'required',
		'losepoints' => 'required',
		'active' => 'required'
	);

	public static function getData($skillbrackettype_id){
		return Skillbrackettype::where("id", $skillbrackettype_id);
	}
}
