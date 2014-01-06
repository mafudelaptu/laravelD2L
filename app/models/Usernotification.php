<?php

class Usernotification extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function getNotifications($user_id){
		$ret = array();
		$retData = array();
		$globalCount = 0;

		// Open Matches
		$data = Match::getAllOpenMatchesOfUser($user_id)->get();
		// $queries = DB::getQueryLog();
		// dd($queries);
		// dd($data);
		if(!empty($data)){
			if($data[0]->id != null){
				$tmp = array();
				$generalOpen = count($data);
				$subMissing = 0;
				foreach($data as $match){
					$submitted = $match->submitted;
					$cancelSubmits = (int) $match->cancelSubmits;
					if($submitted === 0 && $cancelSubmits === 0 ){
						$subMissing++;
					}
				}
				$tmp['count'] = $generalOpen;
				$matchString = ($generalOpen > 1 ? 'matches' : 'match');
				if($subMissing > 0){
					$matchString .= ' <span class="t text-danger" title="missing submits">('.$subMissing.')</span>';
				}
				$tmp['message'] = "open ".$matchString;
				$tmp['href'] = URL::to("openMatches");

				$retData[] = $tmp;
				$globalCount++;
			}
		}

		$ret['data'] = $retData;
		$ret['count'] = $globalCount;
		$ret['status'] = true;
		//dd($ret);
		return $ret;
	}
}
