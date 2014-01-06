@section('content')
    <h1>{{$heading}} <small>MatchID:{{$match_id}}</small></h1>
    @if(!empty($matchPlayersData))
    	 @include("matches.match.info")
    	 @include("matches.match.team", array('data' => $matchPlayersData[1], "team_id" => 1))
    	 @include("matches.match.middle_area", array('matchmode' => $matchData['matchmode'], "region" => $matchData['region'], "mm_shortcut" => $matchData['mm_shortcut'], "r_shortcut" => $matchData['r_shortcut']))

    	 @include("matches.match.team", array('data' => $matchPlayersData[2], "team_id" => 2))

    	 <div class="row">
    	 	<div class="col-sm-6">@include("prototypes.chat.chat", array("chatname"=>"MatchChat".$matchData['id']))</div>
    	 	<div class="col-sm-6"></div>
    	 </div>
    @else
    	<p>access denied!</p>
    @endif
@stop