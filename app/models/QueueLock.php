<?php

class QueueLock extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	protected $table = "queuelocks";
	protected $primaryKey = 'user_id';
	public $timestamps = false;

	public static function checkLock($user_id){
		$ret = array("time" => 0, "sec" => 0, "status" => false );

		$lock = QueueLock::find($user_id);
		
		if($lock){
			
			$timeLeft = strtotime($lock->locked_until) - time();
			if($timeLeft > 0){
				$time = date("i:s",$timeLeft); // 63 sec puffer
				$tmp = explode(":", $time);
				$min = $tmp[0];
				$sec = $tmp[1];
			}
			else{
				$min = "0";
				$sec = "0";
			}

			$ret['time'] = $min." minutes and ".$sec." seconds";
			$ret['status'] = false;
		}	
		else{
			$ret['status'] = true;
		}
		return $ret;
	}
}
