<?php

class PermaBan extends Eloquent {
	protected $guarded = array();
	public $timestamps = false;

	public static $rules = array(
		'user_id' => 'required',
		'banlistreason_id' => 'required',
		'banned_at' => 'required'
	);

	public function banlistreasons(){
		return $this->hasMany("BanlistReason", "id");
	}

	public function user(){
		return $this->belongsTo("User", "id");
	}

	public static function isUserPermaBanned($user_id){
		$user = PermaBan::where("id", $user_id)->get();
		if(!empty($user)){
			return true;
		}
		else{
			return false;
		}
	}
}
