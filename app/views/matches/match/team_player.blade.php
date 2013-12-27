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
				   <li><a href="profile.php?ID={$v.SteamID}" target="_blank"><i class="icon-user"></i> show Profile</a></li>
				    <li class="divider"></li>
				    <li><a href="https://dotabuff.com/players/{$v.SteamID}" target="_blank">show DotaBuff-Profile</a></li>
				    <li><a href="{$v.ProfileURL}ProfileURL" target="_blank">show Steam-Profile</a></li>
				  </ul>
		</div>

		<button class="btn btn-sm btn-default" data-toggle="popover" title="" data-content="Wins: <span class='text-success'>{$v.Wins}</span> Losses: <span class='text-error'>{$v.Losses}</span> Winrate: <span class='text-warning'>{$v.WinRate}%</span> Leaves: {$v.Leaves}" data-original-title="User-Statistics">@include("icons.match_stats")</button>

		
		<button class="btn btn-default btn-sm t" title="Ping Player!" onclick="sendPingNotification(this)" data-value="{$v.SteamID}">
			@include("icons.match_ping_player")
		</button>
		
	</div>
	<div class="col-sm-2">
		@if($inMatch && Auth::user()->id != $playerdata['user_id'])
			<button class="btn btn-sm btn-success" value="{$v.SteamID}" data-type="1" data-value="7" data-label="Upvote">@include("icons.match_upvote")</i>&nbsp;</button>

			<button class="btn btn-sm btn-danger" value="{$v.SteamID}" data-type="-1" data-value="8" data-label="Downvote">@include("icons.match_downvote")</i>&nbsp;</button>
		@endif
	</div>
</div>