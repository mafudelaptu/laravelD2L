<div class="row">
	<div class="col-sm-5">
		@include("profile.userInfo.index")
		<hr>
		@include("profile.userStats.index")
	</div>
	<div class="col-sm-4">
		@include("profile.awards.index")

		@include("profile.matchStats.mmrankings")
	</div>
	<div class="col-sm-3">
		@include("profile.matchStats.last_matches")
	</div>
</div>


<div class="row" id="graphArea">
	<div class="col-sm-4">
		@include("profile/graphs/pointRose")
	</div>
	<div class="col-sm-8">
		@include("profile/graphs/pointHistory")
	</div>
</div>
