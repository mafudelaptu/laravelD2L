<?php

class ProfileController extends BaseController {

	protected $layout = "master";
	protected $title = "Profile";

	public function showProfile($user_id){
		$this->layout->title = $this->title;
		
		if($user_id == Auth::user()->id){
			$visitor = false;
		}
		else{
			$visitor = true;
		}
		
		// get Userdata
		$userData = User::getUserData($user_id)->first();
		$statsOfUser = User::getStatsOfUser($user_id);
		$credits = Usercredit::getCreditCount($user_id);

		$nextSkillbracket = User::getRequirementsForNextSkillbracket($user_id, $statsOfUser['stats'], $credits);
		$lastMatches = Match::getLastMatches($user_id, 5);

		// all warns
		$warns = Banlist::getAllBans($user_id)->join("banlistreasons", "banlistreasons.id", "=", "banlists.banlistreason_id")
						->leftJoin("users", "users.id", "=", "banlists.bannedBy")
						->select(
							"banlists.*",
							DB::raw("DATE_ADD(banlists.created_at, INTERVAL ".GlobalSetting::getBanDecayTime()." second) as expires"),
							"users.avatar as bannedByAvatar",
							"users.name as bannedByName",
							"banlistreasons.name as banReasonText"
							)->get();

		$contentData = array(
			"visitor" => $visitor,
			"userData" => $userData,
			"points" => $statsOfUser['points'],
			"stats" => $statsOfUser['stats'],
			"lastMatches" => $lastMatches['data'],
			"lastMatchesLeaverArray" =>  $lastMatches['leaverArray'],
			"credits" => $credits,
			"matchmodes" => Matchmode::getAllActiveModes()->get(),
			"matchtypes" => Matchtype::getAllActiveMatchtypes()->get(),
			"nextSkillbracket" => $nextSkillbracket['data'],
			"skillbracket" => Userskillbracket::getSkillbracketsAsArray($user_id, true),
			"activeBansCount" => Banlist::getAllActiveBans($user_id)->count(),
			"allBansCount" => Banlist::getAllBans($user_id)->count(),
			"bansData" => $warns,
			"bestRankings" => null,
			);
		//dd($contentData);
		$this->layout->nest("content", 'profile/index', $contentData);
	}
}
