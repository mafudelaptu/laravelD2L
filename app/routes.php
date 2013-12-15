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
	return View::make("start.index")
	->with("title", $title);
});


Route::group(array('before' => 'auth'), function()
{
	Route::get('/', 'HomeController@home');
	Route::get('find_match', 'FindMatchController@index');

	Route::get('ladder', function()
	{
		$title = "Ladder";
		return View::make('ladder.index')
		->with("title", $title);
	});

	Route::get('faq', function()
	{
		$title = "FAQ";
		return View::make('help.faq')
		->with("title", $title);
	});

	Route::get('rules', function()
	{
		$title = "Rules";
		return View::make('help.rules')
		->with("title", $title);
	});

	// ajax
	// findMatch
	Route::post("find_match/checkJoinQueue", array('before' => 'csrf', 'uses' => 'GameQueuesController@checkJoinQueue'));
	Route::post("find_match/joinQueue", array('before' => 'csrf', 'uses' => 'GameQueuesController@joinQueue'));
	Route::get("find_match/getMMInfo", array('before' => 'csrf', 'uses' => 'FetchViewController@getMMInfo'));
	Route::get("find_match/doMatchmaking", array("before" => "csrf", "uses" => "GameQueuesController@doMatchmaking"));
	Route::get("find_match/getReadyMatch", array("before" => "csrf", "uses" => "FetchViewController@getReadyMatch"));
	Route::post("find_match/setQueueLock", array("before" => "csrf", "uses" => "QueuelocksController@setQueueLock"));
	Route::post("find_match/cleanUpFailedQueue", array("before" => "csrf", "uses" => "MatchmakingController@cleanUpFailedQueue"));
	Route::post("find_match/leaveQueue", array("before" => "csrf", "uses" => "GameQueuesController@leaveQueue"));
	
	// general
	Route::post("setRegion", array('before' => 'csrf', 'uses' => 'RegionsController@setRegion'));

	//matchmode
	Route::get("matchmodes/getQuickJoinModes", array('before' => 'csrf', 'uses' => 'MatchmodesController@getQuickJoinModes'));

	/* 
	// Admin
	*/
	Route::group(array('before' => 'admin'), function(){
		Route::get("admin", "AdminController@home");

		Route::post("admin/queue/insertInQueue", "GameQueuesController@insertRandomUserIntoQueue");

	});

});

// Login/logout stuff
Route::get('login/{action?}','SteamController@login');
Route::get('logout', 'SteamController@logout');
if(Config::get('app.debug') == true){
	Route::get('fakelogin', function(){

		$user = User::getFakeUser();
		$user = $user[0];
		$fakeUser = User::find($user->id);
		Auth::login($fakeUser);
		//var_dump($fakeUser->id);
		// set first Skillbrackets
		Userskillbracket::setSkillbrackets($user->id);
		
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