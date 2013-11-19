<?php

class GlobalSetting extends Eloquent {
	protected $guarded = array();
	protected $table = "globalsettings";
	public static $rules = array();

	public static function getBasePoints(){
		$basePoints = GlobalSetting::find(1);
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
		$ret = GlobalSetting::find(2);
		if($ret->active == 1){
			return $ret->value;
		}
		else{
			return 0;
		}
	}

	public static function getJustCM(){
		$ret = GlobalSetting::find(4);
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
}
