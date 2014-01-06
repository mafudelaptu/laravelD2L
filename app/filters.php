<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('start');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter("admin", function(){
	if(Auth::user()->admin != 1){
		return Redirect::guest('start');
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
   if (Session::token() != $token) {
      throw new Illuminate\Session\TokenMismatchException;
   }
});

View::composer("featured.stats", function($view){
	$default_region = (int) GlobalSetting::getDefaultRegionID();

	$view->with("uniqueUser", (int)User::getAllUsers()->count())
	->with("matchesPlayed", (int)Match::getAllMatchesPlayed()->count())
	->with("usersInQueue", (int)GameQueue::getAllUsersInQueueByRegion($default_region)->count())
	->with("liveMatches", (int)Match::getAllLiveMatches()->count());
});

View::composer("navigation.region", function($view){
	if(Auth::check()){
		$regions = Region::getAllActiveRegions()->get();
		$selected_region_shortcut = Auth::user()->region->shortcut;
		$view->with("regions", $regions)
			->with("selected_region", $selected_region_shortcut);

	}
});


View::composer("navigation.usernavi", function($view){
	if(Auth::check()){
		$view->with("userAvatar", Auth::user()->avatar)
			->with("userName", Auth::user()->name);
	}
});

View::composer("navigation.notification", function($view){
	if(Auth::check()){
		
		$notificationData = Usernotification::getNotifications(Auth::user()->id);
		$view->with("data", $notificationData['data'])
		->with("count", $notificationData['count']);
	}
});