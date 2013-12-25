<?php

class Uservotecount extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'upvotes' => 'required',
		'downvotes' => 'required'
	);
}
