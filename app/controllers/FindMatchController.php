<?php

class FindMatchController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	protected $layout = "master";
	protected $title = "Find Match";

	public function index(){
		$this->layout->title = $this->title;
		$qs5vs5Single = array(
			"queueCount" => (int) GameQueue::getPlayersInQueue(1)->groupBy("user_id")->count(),
			"openMatches" => 0,
			"maxMatchmode" => "",
			"maxRegion" => "",
			);
		$queueStats5vs5Single = json_decode(json_encode($qs5vs5Single), FALSE);

		$qs1vs1 = array(
			"queueCount" => (int) GameQueue::getPlayersInQueue(2)->groupBy("user_id")->count(),
			"openMatches" => "",
			"maxMatchmode" => "",
			"maxRegion" => "",
		);
		$queueStats1vs1 = json_decode(json_encode($qs1vs1), FALSE);
		
		$contentData = array(
			"heading" => $this->title,
			"matchtypes" => Matchtype::getAllActiveMatchtypes()->get(),
			"queueStats5vs5Single" => $queueStats5vs5Single,
			"queueStats1vs1" => $queueStats1vs1,
			"matchmodes" => Matchmode::getAllActiveModes()->get(),
			"inMatch" => Match::isUserInMatch(Auth::user()->id),
			);

		$this->layout->nest("content", 'findMatch.index', $contentData);

	}

}