<?php

class MatchvotesController extends BaseController {

	/**
	 * Matchvote Repository
	 *
	 * @var Matchvote
	 */
	protected $matchvote;

	public function cancelVote(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$votetype = Input::get("votetype");
				$match_id = Input::get("match_id");
				$user_id =  Auth::user()->id;
				$votesArray = Input::get("leaverArray");
				
				if(Match::isUserInMatch($user_id, $match_id)){
					
					Matchvote::insertCancelVote($match_id, $user_id);
					Matchdetail::submitResult($user_id, $match_id, "cancel");
					// matched_user clearen
					Matched_user::removeMatchedUserEntry($match_id, $user_id);
					
					if($votetype == "1"){
						if(is_array($votesArray) && count($votesArray) > 0){
							foreach ($votesArray as $key => $leaver) {
								if(Match::isUserInMatch($leaver, $match_id)){
									Matchvote::insertLeaverVote($match_id, $user_id, $leaver);
								}
							}
						}
						$ret['status'] = true;
					}
					else{						
						$ret['status'] = false;
					}
				}
				else{
					$ret['status'] = "notInMatch";
				}
			}
		}
		return $ret;
	}

	public function __construct(Matchvote $matchvote)
	{
		$this->matchvote = $matchvote;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$matchvotes = $this->matchvote->all();

		return View::make('matchvotes.index', compact('matchvotes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('matchvotes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Matchvote::$rules);

		if ($validation->passes())
		{
			$this->matchvote->create($input);

			return Redirect::route('matchvotes.index');
		}

		return Redirect::route('matchvotes.create')
		->withInput()
		->withErrors($validation)
		->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$matchvote = $this->matchvote->findOrFail($id);

		return View::make('matchvotes.show', compact('matchvote'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$matchvote = $this->matchvote->find($id);

		if (is_null($matchvote))
		{
			return Redirect::route('matchvotes.index');
		}

		return View::make('matchvotes.edit', compact('matchvote'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Matchvote::$rules);

		if ($validation->passes())
		{
			$matchvote = $this->matchvote->find($id);
			$matchvote->update($input);

			return Redirect::route('matchvotes.show', $id);
		}

		return Redirect::route('matchvotes.edit', $id)
		->withInput()
		->withErrors($validation)
		->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->matchvote->find($id)->delete();

		return Redirect::route('matchvotes.index');
	}

}
