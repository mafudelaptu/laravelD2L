<?php

class GlobalSetting extends Eloquent {
	protected $guarded = array();
	protected $table = "globalsettings";
	public static $rules = array();

	public static function getBasePoints(){
		$basePoints = GlobalSetting::where("id", 1)->remember(60)->first();
		if(!empty($basePoints)){
			if($basePoints->active == 1){
				$bPVal = $basePoints->value;
			}
			else{
				$bPVal = 0;
			}

		}
		else{
			$bPVal = 0;
		}
		return $bPVal;
	}

	public static function getDefaultRegionID(){
		$ret = GlobalSetting::where("id", 2)->remember(60)->first();
		if($ret->active == 1){
			return $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getDuoJoin(){
		$ret = GlobalSetting::where("id", 3)->remember(60)->first();
		if($ret->active == 1){
			return true;
		}
		else{
			return false;
		}
	}

	public static function getJustCM(){
		$ret = GlobalSetting::where("id", 4)->remember(60)->first();
		if(!empty($ret)){
			if($ret->active == 1){
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 0;	
		}
		
	}

	public static function getQueueLockTime(){
		$ret = GlobalSetting::where("id", 5)->remember(60)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getWeeklyUpvoteCount(){
		$ret = GlobalSetting::where("id", 6)->remember(60)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getWeeklyDownvoteCount(){
		$ret = GlobalSetting::where("id", 7)->remember(60)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getCreditBorders(){
		$ret = GlobalSetting::where("id", 8)
		->orWhere("id", 9)
		->orWhere("id", 10)
		->remember(60)
		->get();
		if(!empty($ret)){
			$borderArray = array();
			foreach ($ret as $key => $credit) {
				if ($credit->id == 8) {
					$borderArray["bronze"] = $credit->value;
				}
				elseif ($credit->id == 9) {
					$borderArray["silver"] = $credit->value;	
				}
				elseif($credit->id == 10){
					$borderArray["gold"] = $credit->value;
				}
			}
			return $borderArray;
		}
		else{
			return null;
		}
	}

	public static function getMatchLeaverPunishment(){
		$ret = GlobalSetting::where("id", 11)->remember(60)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getQuickJoinMatchmode(){
		$ret = GlobalSetting::where("id", 12)->remember(60)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getBanCreditBorder(){
		$ret = GlobalSetting::where("id", 13)->remember(60)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return -99999;
		}
	}

	public static function getWeeklyVoteCountUpdateDay(){
		$ret = GlobalSetting::where("id", 14)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return null;
		}
	}
	
	public static function getPermaBanBorder(){
		$ret = GlobalSetting::where("id", 15)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return 999999;
		}
	}

	public static function getBanDecayTime(){
		$ret = GlobalSetting::where("id", 16)->first();
		if($ret->active == 1){
			return (int) $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getTeamsActive(){
		$ret = GlobalSetting::where("id", 17)->first();
		if($ret->active == 1){
			return true;
		}
		else{
			return false;
		}
	}

	public static function getLoginVia(){
	$ret = GlobalSetting::where("id", 18)->first();
		if($ret->active == 1){
			return $ret->value;
		}
		else{
			return "Steam";
		}	
	}

	public static function getForumLink(){
	$ret = GlobalSetting::where("id", 19)->first();
		if($ret->active == 1){
			return $ret->value;
		}
		else{
			return "";
		}	
	}

	public static function getForumHost(){
	$ret = GlobalSetting::where("id", 20)->first();
		if($ret->active == 1){
			return $ret->value;
		}
		else{
			return "";
		}	
	}

	public static function getCancelBorderForMatchtype($matchtype_id){
		switch ($matchtype_id) {
			case 2:
			return 2;
			break;
			
			default:
			return 6;
			break;
		}
	}
}
