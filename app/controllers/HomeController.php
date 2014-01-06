<?php

class HomeController extends BaseController {

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
	protected $title = "Home Page";
	
	public function home(){
		$this->layout->title = $this->title;
		$lastMatchesData =  Match::getGlobalLastMatches(5);
		$contentData = array(
			"heading" => $this->title,
			"newsData" => News::getAllActiveNews()->get(),
			"streamerData" => Streamer::getAllPlayingStreamers(5),
			"bestPlayers" => Ladder::getBestPlayers(1,5),
			"lastMatches" => $lastMatchesData->get(),
			"matchmodes" => Matchmode::getAllActiveModes()->get(),
			"highestCredits" => Usercredit::getHighestUserCredits(5)->get(),
			);
		$this->layout->nest("content", 'home.index', $contentData);
	}

	// public function showWelcome()
	// {
	// 	if(Auth::check()){
	// 		$this->layout->title = $this->title;
			
	// 		$default_region = GlobalSetting::getDefaultRegionID();
			
	// 		$contentData = array(
	// 			"heading" => $this->title,
	// 			);
	// 		$this->layout->nest("content", 'home.index', $contentData);
			
	// 		$headerData = array(
	// 			"uniqueUser" => $User->getAllUsers()->count(),
	// 			"matchesPlayed" => Match::getAllMatchesPlayed()->count(),
	// 			//"usersInQueue" => GameQueue::getAllUsersInQueueByRegion($default_region)->count(),
	// 			"liveMatches" => "",
	// 			);

	// 		$this->layout->nest("featured", "featured.index", $headerData);

	// 	}
	// 	else{
	// 		return Redirect::to("start");
	// 	}

		
	// }



}