@section("content")
<h1>{{$heading}}</h1>
<div class="row">
	<div class="col-sm-8">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#news" data-toggle="tab">News</a></li>
			<li><a href="#stream" data-toggle="tab">Stream</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="news">
				@include("home.news.index")
			</div>
			<div class="tab-pane" id="stream">
				@include("home.stream.index")
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		@include("home.liveStreams.index", array("data"=>$streamerData['data']))
	</div>
</div>
<div class="alert alert-info">
	space for Banners/Ads
</div>
<div>
	event data
</div>
<div class="customH2">
	Wall<span>OF</span>Fame
</div>
<div class="row">
	<div class="col-sm-4">
		@include("home.wallOfFame.bestPlayers.index", array("data"=>$bestPlayers))
	</div>
	<div class="col-sm-4">
		@include("home.wallOfFame.lastMatches.index", array("data"=>$lastMatches))
	</div>
	<div class="col-sm-4">
		@include("home.wallOfFame.highestCredits.index", array("data"=>$highestCredits))
	</div>
</div>
@stop