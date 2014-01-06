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
			"teamStats" => Match::getAveragePointsOfTeams($matchdetailsData, $matchData->matchtype_id),
			"userVotes" => Uservote::getVotesOfUser($user_id, $match_id)->lists("user_id"),
			"voteStats" => Uservote::getVoteStatsForMatch($match_id, $matchdetailsData),
			);

		//dd($contentData);
		$this->layout->nest("content", 'matches.match.index', $contentData);
	}

	public function showOpenMatches(){
		$title = "Open Matches";
		$this->layout->title = $title;

		$user_id = Auth::user()->id;

		$openMatches = Match::getAllOpenMatches($user_id)
							->join("matchdetails", "matchdetails.match_id", "=", "matches.id")
							->join("matchmodes", "matchmodes.id", "=", "matches.matchmode_id")
							->join("matchtypes", "matchtypes.id", "=", "matches.matchtype_id")
							->where("matchdetails.user_id", $user_id)
							->select(
								"matches.*",
								"matchdetails.submitted",
								"matchmodes.name as matchmode",
								"matchmodes.shortcut as mm_shortcut",
								"matchtypes.name as matchtype"
								)
							->get();

		if(!empty($openMatches)){
			$submitCountsArray = array();
			foreach ($openMatches as $key => $match) {
				$submitCountsArray[$match->id] = (int) Matchdetail::getSubmitCountOfMatch($match->id);
			}
		}
		$contentData = array(
			"heading" => $title,
			"data" => $openMatches,
			"submitCountsArray" => $submitCountsArray,
			);

		//dd($contentData);
		$this->layout->nest("content", 'matches.openMatches.index', $contentData);
	}


	function submitResult(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$result = Input::get("result");
				$match_id = Input::get("match_id");
				$user_id =  Auth::user()->id;
				if(Match::isUserInMatch($user_id, $match_id)){
					Matchdetail::submitResult($user_id, $match_id, $result);
					$ret['status'] = true;
				}
				else{
					$ret['status'] = false;
				}
				return $ret;
			}
		}
	}

	function votePlayer(){
		$ret = array();
		if(Auth::check()){
			if (Request::ajax()){
				$vote_user_id = Input::get("user_id");
				$match_id = Input::get("match_id");
				$votetype = Input::get("type");
				$user_id =  Auth::user()->id;

				if(Match::isUserInMatch($user_id, $match_id) && Match::isUserInMatch($vote_user_id, $match_id)){
					$retVote = Uservote::insertVote($user_id, $vote_user_id, $votetype, $match_id);

					if($retVote !== false){

					$ret['status'] = true;
					}
					else{
					$ret['status'] = "insertVoteFail";
						
					}
				}
				else{
					$ret['status'] = "notInMatch";
				}
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
