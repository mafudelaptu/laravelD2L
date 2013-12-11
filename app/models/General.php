<?php

class General {
	public static function recursive_array_search($needle,$haystack) {
		foreach($haystack as $key=>$value) {
			$current_key=$key;
			if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
				return $current_key;
			}
		}
		return false;
	}

	public static function getAvePointsOfTeam($array){
		$ret = array();
		if(is_array($array) && count($array) > 0){
                                //$ret['debug'] .= p($array,1);
			$sum1 = 0; $sum2 = 0; $count1 = 0; $count2 = 0;
			foreach ($array as $k => $v) {
				$teamID = $v['TeamID'];
				$points = $v['Rank'];
				if($teamID == 1){
					$sum1 += $points;
					$count1++;
				}
				else{
					$sum2 += $points;
					$count2++;
				}
			}

			$ave1 = ($count1 > 0 ? $sum1/$count1 : 0);
			$ave2 = ($count2 > 0 ? $sum2/$count2 : 0);
			$ret['debug'] .= p("S:".$sum1." C:".$count1." S2:".$sum2." C2:".$count2." A:".$ave1." A2:".$ave2,1);
			$ret['ave1'] = $ave1;
			$ret['ave2'] = $ave2;
			if($ave1 <= $ave2){
				$ret['data'] = 1;
			}
			else{
				$ret['data'] = 2;
			}
			$ret['status'] = true;
		}
		else {
			$ret['status'] = false;
		}
		return $ret;
	}
}
