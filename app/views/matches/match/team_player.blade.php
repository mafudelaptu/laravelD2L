{{-- set variables --}}
{{
	$userHighligh = "";
	if(Auth::user()->id == $playerdata['user_id']){
		$userHighligh = "highlight";
	}

}}
<div class="row">
	<div class="col-sm-5">
		@include("prototypes.username", array("credits" => $playerdata['credits'],"username" => $playerdata['name'],"user_id" => $playerdata['user_id'],"truncateValue" => 0, "avatar" => $playerdata['avatar']))
	</div>
	<div class="col-sm-2">
		@include("matches.match.team_player_points", array("points" => $playerdata['points'], "winPoints" => $playerdata['winPoints'], "losePoints" => $playerdata['losePoints'], "pointsChange" => $playerdata['pointschange']))
	</div>
	<div class="col-sm-3" style="text-align: right">
		<div class="btn-group">
				  <a class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
				    @include("icons.match_user_menu")
				    <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu">
				   @include("matches.match.team_player_button_playerinfo", array("user_id" => Auth::user()->id))
				  </ul>
		</div>

		<button class="btn btn-sm btn-default" data-toggle="popover" title="" data-content="Wins: <span class='text-success'>{{$playerdata['stats']['Wins']}}</span> Losses: <span class='text-error'>{{$playerdata['stats']['Losses']}}</span> Winrate: <span class='text-warning'>{{$playerdata['stats']['WinRate']}}%</span> Leaves: {{$playerdata['stats']['Leaves']}}" data-original-title="User-Statistics" data-trigger="hover" data-html="true" data-placement="top">@include("icons.match_stats")</button>

		
		<button class="btn btn-default btn-sm t" title="Ping Player!" onclick="sendPingNotification(this)" data-value="{$v.SteamID}">
			@include("icons.match_ping_player")
		</button>
		
	</div>
	<div class="col-sm-2">
		
		@if($inMatch && Auth::user()->id != $playerdata['user_id'])
			{{--dd($userVotes)--}}
			@if(array_search($playerdata['user_id'], $userVotes))
							
			@include("matches.match.team_player_vote_info", array("votestats" => $voteStats[$playerdata['user_id']]))
			
			
			@else
			
			@include("matches.match.team_player_vote_buttons", array("user_id" => $playerdata['user_id']))
			
			@endif
			
		@endif
		
	</div>
</div>