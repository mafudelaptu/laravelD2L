<?php

class MatchmakingController extends BaseController {

	public function cleanUpFailedQueue(){
		if(Auth::check()){
			if (Request::ajax()){
				$match_id = Input::get("match_id");
				$reason = Input::get("reason");

				$ret = array();
                $ret['debug'] = "Start cleanUpFailedQueue <br>\n";
                // clean Queue
                $retKAPOFQ = GameQueue::kickAllUsersOutOfQueue($match_id);
                $ret['debug'] .= p($retKAPOFQ,1);

                // clean DBMM
                $retMM = Matched_user::cleanMatchedUsers($match_id);
                $ret['debug'] .= p($retMM,1);
                
                // clean MatchDetails
                $retMD = Matchdetail::deleteMatchdetails($match_id);
                $ret['debug'] .= p($retMD,1);
                
                // clean created Match
                $retM = Match::deleteCreatedMatch($match_id);
                $ret['debug'] .= p($retM,1);
                
                // clean Host of Match
                $retHFM = Matchhost::deleteHost($match_id);
                $ret['debug'] .= p($retHFM,1);
                
                // prio Queue resetten für bestimmte faelle
                switch($reason){
                        case "declined":
                        case "autoKick":
                                // TODO
                        		//$_SESSION['user']['joinTimestamp'] = 0;
                                break;
                }
                //$ret['session'] = p($_SESSION,1);
                $ret['status'] = true;

                $ret['debug'] .= "End cleanUpFailedQueue <br>\n";
                return $ret;
			}
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('matchmakings.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('matchmakings.create');
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
        return View::make('matchmakings.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('matchmakings.edit');
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

}
