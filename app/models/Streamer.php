<?php

class Streamer extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'channelname' => 'required',
		'lang' => 'required'
		);
	protected $table = 'streamers';
	protected $primaryKey = 'channelname';

	public static function getStreamer($count="*"){

		$data = Streamer::leftJoin("users", "users.id", "=", "streamers.linked_to_user");
		if($count != "*"){
			$data = $data->take($count);
		}
		return $data;
	}

	public static function getAllPlayingStreamers($count="*"){
		$data = Streamer::getStreamer($count)->get();
		if(!empty($data)){
			$channelArray = array();
			foreach ($data as $key => $streamer) {
				$user_id = $streamer->linked_to_user;
				if($user_id > 0){
					if(Match::isUserInMatch()){
						$channelArray[] = $streamer->channelname;
					}
					else{
						unset($data[$key]);
					}
				}
				else{
					$channelArray[] = $streamer->channelname;
				}
				
			}

			$retT = Twitch::getStreamsData($channelArray);

			if(!empty($retT['data']) && !empty($data)){
				$data2 = array();
				foreach ($data as $k => $v) {
					$twitchData = $retT['data'][$v->channelname];

					if(is_array($twitchData) && count($twitchData) > 0){
						if($v->linked_to_user > 0){
							$data2['player'][] = array_merge_recursive($data[$k], $twitchData);
						}
						else{
							$data2['featured'][] = array_merge_recursive($data[$k], $twitchData);
						}
					}

				}
			}

		// sortieren nach viewers
		$retData = array();
			if(!empty($data2)){
				if(is_array($data2['featured']) && count($data2['featured']) > 0){
					$orderedStreamsFeatured = General::orderArrayBy($data2['featured'],'viewers',SORT_DESC);
				}
				if(is_array($data2['player']) && count($data2['player']) > 0){
					$orderedStreamsPlayer = General::orderArrayBy($data2['player'],'viewers',SORT_DESC);
				}


				for($i=0; $i<$limit; $i++){
					if($orderedStreamsFeatured[$i]){

						$retData['featured'][] = $orderedStreamsFeatured[$i];
					}
					if($orderedStreamsPlayer[$i]){

						$retData['player'][] = $orderedStreamsPlayer[$i];
					}
				}
			}
			

			$ret['data'] = $retData;
			$ret['status'] = true;
		}
		return $ret;
	}
}
