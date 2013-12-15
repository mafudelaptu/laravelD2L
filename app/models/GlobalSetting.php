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
}
