<?php

class BanlistReason extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required'
	);

	public function permaBan(){
		return $this->belongsTo("PermaBan", "banlistreason_id");
	}
}
