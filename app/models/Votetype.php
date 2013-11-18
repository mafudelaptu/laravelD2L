<?php

class Votetype extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'active' => 'required'
	);
}
