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
	
	// general
	Route::post("setRegion", array('before' => 'csrf', 'uses' => 'RegionsController@setRegion'));

	//matchmode
	Route::post("matchmodes/getQuickJoinModes", array('before' => 'csrf', 'uses' => 'MatchmodesController@getQuickJoinModes'));

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