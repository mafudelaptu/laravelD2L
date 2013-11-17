@section("stats")
<div id="header_stats" class="well well-sm">
	<ul>
		<li>Unique User: <strong>{{$uniqueUser}}</strong></li>
		<li>Matches played: <strong>{{$matchesPlayed}}</strong></li>
		<li>Unique currenty in Queue: <strong>{{$usersInQueue}}</strong></li>
		<li>Live Matches: <strong>{{$liveMatches}}</strong></li>
	</ul>
</div>
@show