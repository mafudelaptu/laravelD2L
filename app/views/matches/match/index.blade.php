@section('content')
    <h1>{{$heading}} <small>MatchID:{{$match_id}}</small></h1>
    @if(!empty($matchPlayersData))
    	 @include("matches.match.info")
    	 test
    @else
    	<p>access denied!</p>
    @endif
@stop