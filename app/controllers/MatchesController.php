<?php

class MatchesController extends BaseController {

	protected $layout = "master";
	protected $title = "Match";

	public function showMatch($match_id){
		$this->layout->title = $this->title;
		$user_id = Auth::user()->id;
		$matchStateData = Match::getStateOfMatch($match_id, $user_id);
		$matchData = Match::getMatchData($match_id, true, true)
						->select("matches.*", "matchmodes.name as matchmode", "matchmodes.shortcut as mm_shortcut",
								"regions.name as region", "regions.shortcut as r_shortcut")
						->first();
		
		$matchdetailsData = Matchdetail::getMatchdetailData($match_id, true, true)->orderBy("matchdetails.points")
			->select("matchdetails.*", "users.*", "userpoints.pointschange")
			->get();

		$matchPlayersData = Match::getPlayersData($matchdetailsData, $matchData->matchtype_id);
		
		$contentData = array(
			"heading" => $this->title,
			"match_id" => $match_id,
			"matchState" => $matchStateData['status'],
			"inMatch" => Match::isUserInMatch($user_id, $match_id),
			"host" => Matchhost::getHost($match_id, true)->first(),
			"matchPlayersData" => $matchPlayersData,
			"matchData" => $matchData,
			"voteCounts" => Uservotecount::getVoteCounts($user_id)->first(),
			"team" => Team::getTeamsAsArray(),
			);

		// dd($contentData);
		$this->layout->nest("content", 'matches.match.index', $contentData);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('matches.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('matches.create');
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
        return View::make('matches.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('matches.edit');
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
