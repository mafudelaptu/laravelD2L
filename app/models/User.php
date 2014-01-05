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

	public static function setRegion($user_id, $region_id){
		return DB::table("users")->where("id", $user_id)->update(array("region_id"=> $region_id));
	}

	public function permaban(){
		return $this->hasOne("Permaban", "user_id");
	}

	public function region(){
		return $this->belongsTo("Region");
	}

	public function userskillbrackets(){
		return $this->belongsTo("Userskillbracket", "user_id");
	}

	public static function getRandomUser(){
		return User::getFakeUser();
	}

	public static function getStatsOfUser($user_id){
		$ret = array();
		if($user_id > 0){
			$matchtypes = Matchtype::getAllActiveMatchtypes()->get();
			if(!empty($matchtypes)){
				$pointsArray = array();
				$gameStatsArray = array();

				// get global Points
				$globalPoints = Userpoint::getPoints($user_id);

				$pointsArray['global'] = $globalPoints;

				foreach ($matchtypes as $key => $mt) {
					$matchtype_id = $mt->id;

					// points
					$points = Userpoint::getPoints($user_id, $matchtype_id);
					$pointsArray[$matchtype_id] = $points;

					//gamestats
					$stats = Userpoint::getGameStats($user_id, $matchtype_id);
					$gameStatsArray[$matchtype_id] = $stats['data'];
				}

				$ret['points'] = $pointsArray;
				$ret['stats'] = $gameStatsArray;
				$ret['status'] = true;
			}
			else{
				$ret['status'] = "no active matchtypes";
			}
			

		}
		else{
			$ret['status'] = false;
		}
		return $ret;
	}

	public static function getRequirementsForNextSkillbracket($user_id, $gamestats=array(), $credits=false){
		$ret = array();
		$matchtypes = Matchtype::getAllActiveMatchtypes()->get();
		if(!empty($matchtypes)){
			$data = array();
			foreach ($matchtypes as $key => $mt) {
				$matchtype_id = $mt->id;
				
				$data[$matchtype_id] = array();
				// gamestats
				if(count($gamestats) > 0){
					$stats = $gamestats[$matchtype_id];
				}
				else{
					// selber auslesen
				}

				if($credits == false){
					// selber auslesen
				}

				// current skillbracket
				$skillbracket = Userskillbracket::getSkillbracket($user_id, $matchtype_id)->first();

				// next Skillbracket data
				$nextSkillbracket = Skillbrackettype::getData(($skillbracket->id+1))->first();
				if(!empty($nextSkillbracket)){

					switch ($nextSkillbracket->id) {
						case 2 :
						$nextTotalGames = 0;
						$nextWinRate = 0;
						break;
						case 3 :
						$nextTotalGames = Userskillbracket::totalGamesAmateur;
						$nextWinRate = Userskillbracket::winRateAmateur;
						break;
						case 4 :
						$nextTotalGames = Userskillbracket::totalGamesSkilled;
						$nextWinRate = Userskillbracket::winRateSkilled;
						break;
						case 5 :
						$nextTotalGames = Userskillbracket::totalGamesExpert;
						$nextWinRate = Userskillbracket::winRateExpert;
						break;
						case 6 :
						$nextTotalGames = Userskillbracket::totalGamesMaster;
						$nextWinRate = Userskillbracket::winRateMaster;
						break;
					}
					$data[$matchtype_id]['nextSkillbracket'] = $nextSkillbracket->name;
					$data[$matchtype_id]['nextTotalGames'] = (int)$nextTotalGames;
					$data[$matchtype_id]['nextWinRate'] = (int)$nextWinRate;

					// berechnung wieviel noch fehlt
					$currentGames = $stats ['TotalGames'];
					$currentWinRate = $stats ['WinRate'];

					$data[$matchtype_id]['currentGames'] = $currentGames;
					$data[$matchtype_id]['currentWinRate'] = $currentWinRate;
					$data[$matchtype_id]['currentCredits'] = $credits;

					$data[$matchtype_id]['neededGames'] = (($nextTotalGames - $currentGames) > 0 ? ($nextTotalGames - $currentGames) : 0);
					$data[$matchtype_id]['neededWinRate'] = round((($nextWinRate - $currentWinRate) > 0 ? ($nextWinRate - $currentWinRate) : 0),2);
					$data[$matchtype_id]['neededCredits'] = (($credits > 0 ? 0 : ((-1)*$credits)+1));

					$currentActiveWarns = (int) Banlist::getAllActiveBans($user_id)->count();
					$neededWarnGames = $currentActiveWarns*10;

					$data[$matchtype_id]['activeWarns'] = (int)$currentActiveWarns;
					$data[$matchtype_id]['neededWarnTotalGames'] = (int)$neededWarnGames;
					if($neededWarnGames <= $currentGames){
						$data[$matchtype_id]['neededWarnGames'] = 0;
					}
					else{
						$data[$matchtype_id]['neededWarnGames'] = $neededWarnGames-$currentGames;
					}
				}
				else{
					$data[$matchtype_id]['nextSkillbracket'] = "";
				}
				
			}

			$ret["data"] = $data;
			$ret['status'] = true;
		}
		else{
			$ret['status'] = "matchtypes null";
		}
		return $ret;
	}

	// public function queues(){
	// 	return $this->hasMany("Queue", "user_id");
	// }
}