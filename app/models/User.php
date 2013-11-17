<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
		//return $this->steam_id;
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public static function getAllUsers(){
		return User::all();
	}

	public static function getUserData($user_id){
		return User::where("id", $user_id);
	}

	public static function getFakeUser(){
		return DB::select("SELECT * FROM users ORDER BY RAND() LIMIT 1 ");
	}

	public function permaban(){
		return $this->hasOne("Permaban", "user_id");
	}
	// public function queues(){
	// 	return $this->hasMany("Queue", "user_id");
	// }
}