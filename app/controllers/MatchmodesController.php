<?php

class MatchmodesController extends BaseController {

	public function getQuickJoinModes(){
		$modes = Matchmode::getQuickJoinModes();
		
		return $modes->get();
	}

	public function getMatchmodeData(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$matchtype_id = Input::get("matchtype_id");
				$selectedArray = Input::get("selectedArray");
				if(!empty($selectedArray)){
					$data = DB::table("matchmodes");
					foreach ($selectedArray as $key => $matchmode_id) {
						if($key === 0){
							$data = $data->where("id", $matchmode_id);
						}
						else{
							$data = $data->orWhere("id", $matchmode_id);
						}
					}
					$ret = $data->get();
				}
				else{
					$ret = array();
				}
			}
		}
		//dd($retData[0]);
		return $ret;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('matchmodes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('matchmodes.create');
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
        return View::make('matchmodes.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('matchmodes.edit');
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
