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
}
