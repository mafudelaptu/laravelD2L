<?php

class SteamController extends \BaseController{

	public function __construct(Hybrid_Auth $hybridAuth)
	{
		$this->hybridAuth = $hybridAuth;
	}

	public function login($action=''){
		if ( $action == "auth" ) {
			try {
				Hybrid_Endpoint::process();
			}
			catch ( Exception $e ) {
				echo "Error at Hybrid_Endpoint process (SteamController@login): $e";
			}
			return;
		}
		// Authenticate with Steam (using the details from our IoC Container).
		$hybridAuthProvider = $this->hybridAuth->authenticate( "Steam" );
		// Get user profile information
		$hybridAuthUserProfile = $hybridAuthProvider->getUserProfile();
		// Get Community ID
		$steamCommunityId = str_replace( "http://steamcommunity.com/openid/id/", "", $hybridAuthUserProfile->identifier );
		
		echo "Hello {$hybridAuthUserProfile->displayName}, your Steam Community ID is $steamCommunityId";

		// Create SteamId Object
		$steamIdObject = new SteamId( "$steamCommunityId" );

		$steam_avatar = $steamIdObject->getIconAvatarUrl();
		$steam_avatarFull = $steamIdObject->getFullAvatarUrl();
		
		$steam_name = $steamIdObject->getNickname();
		$steam_id = $steamIdObject->getSteamId64();

		echo $steam_avatar." ".$steam_name." ".$steam_id;
		//var_dump($steamIdObject);
		$userData = User::find($steam_id);
		var_dump($userData);

		if(!empty($userData)){
			$user = User::find($steam_id);
			var_dump($user);
			Auth::login($user);
		}
		else{
			$date = new \DateTime;
			$user = new User;
			$user->id = $steam_id;
			$user->name = $steam_name;
			$user->avatar = $steam_avatar;
			$user->avatarFull = $steam_avatarFull;
			$user->basePoints = GlobalSetting::getBasePoints();
			$user->basePointsUpdatedTimestamp = $date;
			$user->save();

			$user = User::find($steam_id);

			Auth::login($user);
		}

		return Redirect::to("/");
	}

	public function logout(){
		Auth::logout();
		$this->hybridAuth->logoutAllProviders();
		return Redirect::to("/");
	}
}