<?php

class Banlist extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'banned_at' => 'required',
		'banned_until' => 'required',
		'banlistreason_id' => 'required',
		'display' => 'required',
		'bannedBy' => 'required',
		'reason' => 'required'
	);

	public static function checkForBansOfUser($user_id){
		$ret = array();
		$data = Banlist::where("user_id", $user_id)
		->where("display", 1)
		->where("banned_until", ">", new DateTime)
		->orderBy("banned_until", "DESC");

		$count = $data->count();

		if($count > 0){
			$ret['data'] = $data->take(1);
			$ret['banCount'] = $count;
			$ret['status'] = true;
		}
		else{
			$ret['status'] = false;
		}

		return $ret;
	}

	public static function getAllActiveBans($user_id){
		if($user_id > 0){
			$data = DB::table("banlists")->where("user_id", $user_id)
								->where("display", 1);
			
			return $data;
		}
		else{
			return  "user_id == 0";
		}
	}

	public static function getAllBans($user_id){
		if($user_id > 0){
			$data = DB::table("banlists")->where("user_id", $user_id);
			
			return $data;
		}
		else{
			return  "user_id == 0";
		}
	}

	/*
	 * Copyright 2013 Artur Leinweber
	* Date: 2013-01-01
	*/
	public static function calculateBannedTill($user_id){
		$ret = array();

		if($user_id > 0){
			// bereits vorhandene BanCount auslesen
			$count = Banlist::getAllActiveBans($user_id)->count();

			switch($count){
				// Verwarnung
				case "0":
					$bannedTill = time();
					break;
				// Queue Ban
				case "1":
					// 24h ban
					$bannedTill = time() + (24 * 60 * 60);
					break;
				// Queue Ban
				case "2":
					// 3 Tage ban
					$bannedTill = time() + (24 * 60 * 60*3);
					break;
				// Queue Ban
				case "3":
					// 7 Tage ban
					$bannedTill = time() + (24 * 60 * 60*7);
					break;	
				case "4":
				// 21 Tage Ban
					$bannedTill = time() + (24 * 60 * 60*21);
					break;
				// Queue Ban
				case "5":
					// Perma ban
					$bannedTill = 99999999999;
					break;
			}
			$ret['data'] = $bannedTill;
			$ret['status'] = true;
		}
		else{
			$ret['status'] = "SteamID = 0";
		}
			
		return $ret;
	}

	public static function insertBan($user_id, $banlistreason_id, $reasonText=""){
		switch ($banlistreason_id) {
			case 1: // cronjob
				// banned till
				$retTill = Banlist::calculateBannedTill($user_id);
				$bannedTill = $retTill['data'];
				$date = new DateTime;
				$date->setTimestamp($bannedTill);
				
				$insertArray = array(
					"user_id"=>$user_id,
					"banned_until"=>$date,
					"banlistreason_id"=>$banlistreason_id,
					"display"=>1,
					"bannedBy"=>0,
					"reason"=>$reasonText,
					"created_at"=>new DateTime,
					);
				Banlist::insert($insertArray);
				break;
			
			default:
				# code...
				break;
		}
	}

	public static function getAllUsersWhoHaveToMuchActiveBans(){
		return Banlist::where("banlists.display", 1)
					->leftJoin("permabans", "permabans.user_id", "=", "banlists.user_id")
					->where("permabans.banlistreason_id", null)
					->groupBy("banlists.user_id")
					->having("warnCount", ">=", 6)
					->select("banlists.user_id",
						DB::raw("COUNT(banlists.user_id) as warnCount"));
	}

	public static function getAllUsersThatHaveOldActiveBans($timeDecay){
		$date = new DateTime;
		$date->setTimestamp(time()-$timeDecay);
		return Banlist::where("banlists.display", 1)
					->where("created_at", "<=", $date)
					->leftJoin("permabans", "permabans.user_id", "=", "banlists.user_id")
					->where("permabans.banlistreason_id", null)
					->select("banlists.*");
	}
}
