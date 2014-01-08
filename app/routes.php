<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get("start", function(){
	$title = "Login Page";
	switch (GlobalSetting::getLoginVia()) {
		case "Forum_IPBoard":
			break;
		case "Steam":
		default:
			$data = View::make("start.index");
			break;
	}
	return $data->with("title", $title);
});

//Help
Route::get('help/faq', 'HelpController@showFAQ');
Route::get('help/rules', 'HelpController@showRules');


Route::group(array('before' => 'auth|setSkillbracket'), function()
{

	Route::get('/', 'HomeController@home');
	Route::get('find_match', 'FindMatchController@index');
	

	Route::pattern('match_id', '[0-9]+');
	Route::pattern('user_id', '[0-9]+');
	//match
	Route::get("match/{match_id}", "MatchesController@showMatch");

	//open matches
	Route::get("openMatches", "MatchesController@showOpenMatches");

	// profile
	Route::get("profile", function(){
		 return Redirect::to('profile/'.Auth::user()->id);
	});
	Route::get('profile/{user_id}', 'ProfileController@showProfile');
	
	// ladder
	Route::get("ladder", function(){
		 return Redirect::to('ladder/'.Auth::user()->id);
	});
	Route::get('ladder/{user_id}', 'LadderController@showLadder');

	// ajax
	// findMatch
	Route::post("find_match/checkJoinQueue", array('before' => 'csrf', 'uses' => 'GameQueuesController@checkJoinQueue'));
	Route::post("find_match/joinQueue", array('before' => 'csrf', 'uses' => 'GameQueuesController@joinQueue'));
	Route::get("find_match/getMMInfo", array('before' => 'csrf', 'uses' => 'FetchViewController@getMMInfo'));
	Route::get("find_match/doMatchmaking", array("before" => "csrf", "uses" => "GameQueuesController@doMatchmaking"));
	Route::get("find_match/getReadyMatch", array("before" => "csrf", "uses" => "FetchViewController@getReadyMatch"));
	Route::get("find_match/getWaitingForOtherUsers", array("before" => "csrf", "uses" => "FetchViewController@getWaitingForOtherUsers"));
	Route::get("find_match/checkAllReadyForMatch", array("before" => "csrf", "uses" => "MatchmakingController@checkAllReadyForMatch"));
	Route::post("find_match/setQueueLock", array("before" => "csrf", "uses" => "QueuelocksController@setQueueLock"));
	Route::post("find_match/cleanUpFailedQueue", array("before" => "csrf", "uses" => "MatchmakingController@cleanUpFailedQueue"));
	Route::post("find_match/leaveQueue", array("before" => "csrf", "uses" => "GameQueuesController@leaveQueue"));
	Route::post("find_match/acceptMatch", array("before" => "csrf", "uses" => "MatchmakingController@acceptMatch"));
	
	// general
	Route::post("setRegion", array('before' => 'csrf', 'uses' => 'RegionsController@setRegion'));

	//matchmode
	Route::get("matchmodes/getQuickJoinModes", array('before' => 'csrf', 'uses' => 'MatchmodesController@getQuickJoinModes'));
	Route::get("matchmodes/getMatchmodeData", array('before' => 'csrf', 'uses' => 'MatchmodesController@getMatchmodeData'));

	//match
	Route::get("match/getSubmitModal", array("before" => "csrf", "uses" => "FetchViewController@matchSubmitModal"));
	Route::get("match/getCancelModal", array("before" => "csrf", "uses" => "FetchViewController@matchCancelModal"));
	Route::post("match/submitResult", array("before" => "csrf", "uses" => "MatchesController@submitResult"));
	Route::post("match/votePlayer", array("before" => "csrf", "uses" => "MatchesController@votePlayer"));
	Route::post("match/cancelVote", array("before" => "csrf", "uses" => "MatchvotesController@cancelVote"));

	//profile
	Route::get("profile/getPointsHistoryData", array("before" => "csrf", "uses" => "UserpointsController@getPointsHistoryData"));
	Route::get("profile/getPointRoseData", array("before" => "csrf", "uses" => "UserpointsController@getPointRoseData"));
	
	//ladder
	Route::get("ladder/getLadderData", array("before" => "csrf", "uses" => "LadderController@getLadderData"));
	

	/* 
	// Admin
	*/
	Route::group(array('before' => 'admin'), function(){
		Route::get("admin", "AdminController@home");

		Route::post("admin/queue/insertInQueue", "GameQueuesController@insertRandomUserIntoQueue");
		Route::post("admin/queue/setAllReady", "Matched_usersController@setAllReady");
		Route::post("admin/queue/insertFakeMatchSubmits", "MatchdetailsController@insertFakeMatchSubmits");

	});

});

// Login/logout stuff
Route::get('steamLogin/{action?}','SteamController@login');
Route::get('steamLogout', 'SteamController@logout');
if(Config::get('app.debug') == true){
	Route::get('fakelogin', function(){

		$user = User::getFakeUser();
		$user = $user[0];
		$fakeUser = User::find($user->id);
		Auth::login($fakeUser);
		//var_dump($fakeUser->id);
		// set first Skillbrackets
		Userskillbracket::setSkillbrackets($user->id);
		// set init uservotecounts
		Uservotecount::initUserVoteCounts($user->id);
		
		return Redirect::to("/");
	});
}

// ajax
	

// test geschichten


Route::resource('users', 'UsersController');

Route::resource('globalsettings', 'GlobalsettingsController');

Route::get("chat", function()
{
	return View::make("chat.index");
});

Route::resource('matches', 'MatchesController');

Route::resource('queues', 'QueuesController');


Route::resource('matchtypes', 'MatchtypesController');

Route::resource('matchmodes', 'MatchmodesController');


Route::resource('matchdetails', 'MatchdetailsController');

Route::resource('queuelocks', 'QueuelocksController');

Route::resource('permabans', 'PermabansController');

Route::resource('banlistreasons', 'BanlistreasonsController');

Route::resource('banlists', 'BanlistsController');

Route::resource('votetypes', 'VotetypesController');

Route::resource('userpoints', 'UserpointsController');

Route::resource('regions', 'RegionsController');

Route::resource('matched_users', 'Matched_usersController');

Route::resource('userskillbrackets', 'UserskillbracketsController');

Route::resource('usercredits', 'UsercreditsController');

Route::resource('skillbrackettypes', 'SkillbrackettypesController');

Route::resource('queuelocks', 'QueuelocksController');

Route::resource('matchhosts', 'MatchhostsController');

Route::resource('uservotecounts', 'UservotecountsController');

Route::resource('teams', 'TeamsController');

Route::resource('usernotifications', 'UsernotificationsController');

Route::resource('uservotes', 'UservotesController');

Route::resource('votetypes', 'VotetypesController');

Route::resource('matchvotes', 'MatchvotesController');

Route::resource('pointtypes', 'PointtypesController');

Route::resource('news', 'NewsController');

Route::resource('streamers', 'StreamersController');