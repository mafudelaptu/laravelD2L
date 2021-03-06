<?php

class SteamController extends BaseController{

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
		
		//echo "Hello {$hybridAuthUserProfile->displayName}, your Steam Community ID is $steamCommunityId";

		// Create SteamId Object
		$steamIdObject = new SteamId( "$steamCommunityId" );

		$steam_avatar = $steamIdObject->getIconAvatarUrl();
		$steam_avatarFull = $steamIdObject->getFullAvatarUrl();
		
		$steam_name = $steamIdObject->getNickname();
		$steam_id = $steamIdObject->getSteamId64();

		//echo $steam_avatar." ".$steam_name." ".$steam_id;
		//var_dump($steamIdObject);
		Login::insertNewUserAndLogin($steam_id);
		
		return Redirect::to("/");
	}

	public function logout(){
		Auth::logout();
		$this->hybridAuth->logoutAllProviders();
		return Redirect::to("/");
	}
}