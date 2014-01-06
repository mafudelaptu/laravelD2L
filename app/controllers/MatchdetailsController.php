<?php

class MatchdetailsController extends BaseController {

	public function insertFakeMatchSubmits(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$match_id = Input::get("match_id");
				$teamWin_id = Input::get("team_id");

				$mdData = Matchdetail::getMatchdetailData($match_id)->get();
				if($match_id > 0 && $teamWin_id > 0){
					if(!empty($mdData)){
						foreach ($mdData as $key => $md) {
							$user_id = $md->user_id;
							$team_id = $md->team_id;

							if($teamWin_id == "1"){
								if($team_id == "1"){
									$sfor = 1;
								}
								else{
									$sfor = -1;
								}
							}
							else{
								if($team_id == "1"){
									$sfor = -1;
								}
								else{
									$sfor = 1;
								}
							}
							$updateArray = array(
								"submitted" => 1,
								"submissionFor" => $sfor,
								"sub_date" => new DateTime()
								);
							
							Matchdetail::where("user_id", $user_id)
							->where("match_id", $match_id)
							->update($updateArray);
						}
						$ret['status'] = true;
					}	
					else{
						$ret['status'] = false;
					}
				}
				else{
					$ret['status'] = "inputs wrong";
				}
				
			}
		}
		return $ret;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('matchdetails.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('matchdetails.create');
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
		return View::make('matchdetails.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('matchdetails.edit');
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
