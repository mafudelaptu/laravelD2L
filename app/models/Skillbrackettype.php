<?php

class Skillbrackettype extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'winpoints' => 'required',
		'losepoints' => 'required',
		'active' => 'required'
	);
}
