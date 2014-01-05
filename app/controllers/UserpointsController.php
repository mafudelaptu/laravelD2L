<?php

class UserpointsController extends BaseController {


	public function getPointsHistoryData(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$matchmode_id = Input::get("matchmode_id");
				$matchtype_id = Input::get("matchtype_id");
				$count = Input::get("count");
				$user_id = Input::get("user_id");

				$retUP = Userpoint::getPointsHistoryData($matchmode_id, $matchtype_id, $user_id);

				$ret = $retUP;
			}
		}
		return $ret;
	}

	public function getPointRoseData(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$user_id = Input::get("user_id");

				$retUP = Userpoint::getPointRoseData($user_id);

				$ret = $retUP;
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
        return View::make('userpoints.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('userpoints.create');
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
        return View::make('userpoints.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('userpoints.edit');
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
