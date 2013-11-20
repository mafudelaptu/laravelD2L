<?php

class GameQueuesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('queues.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('queues.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('queues.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('queues.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function checkJoinQueue(){
		if(Auth::check()){
			if (Request::ajax()){
				$ret = array();
				$user_id = Auth::user()->id;
				$type = Input::get("type");
				// leave Queue before, so u cant double queue
				$this->leaveQueue();

				// check Queue Join, allowed to join etc?
				$retQL = QueueLock::checkLock($user_id);
				if($retQL['status'] == true){
					// check if banned?
					$permabanned = PermaBan::isUserPermaBanned($user_id);
					if(!$permabanned){
						$retBL = Banlist::checkForBansOfUser($user_id);
						if($retBL['status'] == false){
							$inMatch = Match::isUserInMatch($user_id);
							if($inMatch['status'] == true){
								$ret['status'] = "inMatch";
							}
							else{
								$ret['status'] = true;
							}
						}
						else{
							$ret['banCount'] = $retBL['banCount'];
							$ret['data'] = $retBL['data'];
							$ret['status'] = "banned";
						}
					}
					else{
						$ret['status'] = "permaBanned";
					}
				}
				else{
					$ret['time'] = $retQL['time'];
					$ret['status'] = "queueLock";
				}
				return $ret;
			}
		}
		else{
			return false;
		}
		
	}

	public function leaveQueue(){
		$user_id = Auth::user()->id;

		$ret = GameQueue::deleteUserOutOfQueue($user_id);

		Session::forget("queueJoinTimestamp");
		return $ret;
	}

	public static function joinQueue(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$ret = array();
				$modes = Input::get("modes");
				$region_id = Auth::user()->region->id;
				$matchtype_id = Input::get("matchtype_id");
				$user_id = Auth::user()->id;
				$inMatch = Match::isUserInMatch($user_id);
				if(!$inMatch){
					// get Points of user
					$points = Userpoint::getPoints($user_id);
					
					if(is_array($modes)){
						$insertArray = array();
						foreach ($modes as $k => $mode) {
							$mode_id = (int) $mode;
							$tmp = array();
							$tmp['user_id'] = $user_id;
							$tmp['matchtype_id'] = $matchtype_id;
							$tmp['matchmode_id'] = $mode_id;
							$tmp['rank'] = $points;
							$tmp['created_at'] = new DateTime;
							$tmp['updated_at'] = new DateTime;
							$tmp['region_id'] = $region_id;
							$tmp['force_search'] = 0;
							$insertArray[] = $tmp;
						}
						
						DB::table('queues')->insert($insertArray);
						$ret['status'] = true;
					}	
				}
				else{
					$ret['status'] = false;
				}
				
			}
		}
		else{
			$ret['status'] = false;
		}
		return $ret;
	}

}
