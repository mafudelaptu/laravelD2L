<div class="row" id="match_middle_area">
	<div class="col-sm-4" align="right">
		<dl class="dl-horizontal">
		  <dt>Matchmode:</dt>
		  <dd><div class="badge badge-info" class="t" title="{{$matchmode}}">{{$mm_shortcut}}</div></dd>
		  <dt>Region:</dt>
		  <dd><div class="badge badge-danger" class="t" title="{{$region}}">{{$r_shortcut}}</div></dd>
		  <dt>MatchID:</dt>
		  <dd><div class="badge">{{$match_id}}</div></dd>
		</dl>
	</div>
	<div class="col-sm-4" align="center">
		<div>
			<div class="label label-default">{{$teamStats['team_1']}}</div>
		</div>
		<div class="h1">VS</div>
		<div>
			<div class="label label-default">{{$teamStats['team_2']}}</div>
		</div>
	</div>
	<div class="col-sm-4">
		
		@if($inMatch && $matchState == "open")
			{{-- in Match und noch nix gemacht --}}
			@include("matches.match.middle_area_result_open")
		@elseif($inMatch && $matchState == "submitted")
			{{-- in Match und submitted --}}
			@include("matches.match.middle_area_result_submitted")
		@elseif($matchState == "closed")
			{{-- Matchresult ist fest --}}
			@include("matches.match.middle_area_result_closed", array("team"=>$team, "team_won_id"=> $matchData->team_won_id))
		@else
			{{-- Besucher: spieler in Match --}}
			@include("matches.match.middle_area_result_visitor")
		@endif
	</div>
	<div class="clearer"></div>
</div>