<div class="row">
	 @if($matchState != "closed")
	 	@if($host->user_id == Auth::user()->id)
	 		<div class="span8">
				<div class="alert alert-info">
					<strong>You are Host of this Match! <br></strong>
					Now go into Dota2 and create a <strong>lobby</strong>. Therefore
					click on <i>"Play"</i> -> <i>"create Lobby"</i>. Set the password to
					the current MatchID: <strong>{$match_id}</strong>, the Matchmode to <strong>{{$matchData.MatchMode}}</strong>
					and Region to <strong>{{$matchData.Region}}</strong>
				</div>
			</div>
	 	@else
	 		@if($host->user_id > 0)
	 			<div class="span8">
					<div class="alert alert-info">
						Host of this Match is <img alt="Avatar" src="{$data.matchdetails.hostAvatar}" width="25" height="25">{$data.matchdetails.hostName}. The Lobby password is <strong>{$matchID}</strong>
					</div>
				</div>
	 		@endif
	 	@endif
	 @endif

	 @if($inMatch)
	     <div class="span4">
			<blockquote class="pull-right">
				<p>
					You have <span id="userUpvotesLeft">{$userVotesAllowed.upvotesCount}</span>
					Upvotes and <span id="userDownvotesLeft">{$userVotesAllowed.downvotesCount}</span>
					Downvotes left
				</p>
				<small><a href="help.php#WhatIsTheCreditSystem"
					target="_blank" class="t"
					title="What is the Credit-System and how does this work? ">How
						does Upvotes/Downvotes work <i class="icon-question-sign"></i>
				</a> </small>
			</blockquote>
		</div>
	 @endif

	 @if($matchData->matchtype_id == 2)
	     <button type="button" class="btn btn-danger" data-toggle="collapse"
		data-target="#demo">Rules</button>
	
		<div id="demo" class="collapse in">
		# In the first week of 1v1 matchmaking, only Shadow Fiend will be allowed.
			<ul>
				<li>Win:
					<ul>
						<li>First to 2 kills</li>
						<li>2 Towers destroyed</li>
					</ul>
				</li>
				<li>Bottle and Runes are allowed, using courier to refill bottle isn't allowed.</li>
				<li>Soulring not allowed.</li>
			</ul>
		</div>
	 @endif
</div>

