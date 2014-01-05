@extends('master')

@section('content')

    <h1>{{$title}}</h1>
    
<h3>Section 1: Submitting results</h3>
<ol>
	<li>After a successfully played match, you must submit the results.
		<ol>
			<li>Submitting wrong results will be punished</li>
			<li>After 48 hours of not submitting a result you will get punished</li>
		</ol>
	</li>
	<li>Punishments for false submissions:
		<ol>
			<li>Incorrect submission or failing to submit in 48 hours: -50 Points.</li>
			<li>If you don't mark the leaver properly, you receive -50 Points.</li>
		</ol>
	</li>
</ol>
<h3>Section 2: Ingame, Disconnects &amp; Lobby</h3>
<ol>
	<li>
		You have to join the lobby with the exact same account as the one registered on our website (including the picture and nickname). If you fail to do so, the match cannot start and a replay cannot be parsed properly. Therefore, if someone fails to join with the correct account, and refuses to do so even after your friendly reminder, you should cancel the game and mark him as a leaver.
	</li>
	<li>If a player calls "gg" in All-chat and no one on their team cancels the countdown, the game is over and the other team are the winners.</li>
	<li>All-chat is there so you can greet the opponents, call "gg/wp", surrender a match ("ff"), or announce a pause.</li>
	<li>In Team-chat:
		<ol>
			<li>Friendly, helpful conversation is of course allowed</li>
			<li>Flaming, racism, and other types of offensive language can be reported in the forums and can result in a ban (you will probably get downvoted as well).</li>
		</ol>
	</li>
	<li>If someone is AFK for more than 3 minutes while the game progresses (not during a pause), they have to be marked as a leaver. If someone refuses to participate in teamfights and clearly is standing in base probably spamming in all-chat or stuff like that, he has to be marked as leaver as well, if you call that out in all-chat and the other team confirms that.</li>
	<li>If someone leaves the game (whether it's on purpose or not), all players have to mark him as a leaver when submitting match results. </li>
		<ol>
			 <li>If a player leaves the game before 5th minute mark, game should be canceled and leaver should be marked.</li>
        	<li>If a player leaves the game after 5th minute mark, game should(?) be continued 4v5 and leaver should be marked once the game ends. (*?* - Fairplay factor: Both teams can agree on cancelling the game if enemy team finds it unfair to snatch a win from a 4v5 match). </li>
		</ol>
       <li>If you disconnected from a match, you are only allowed to reconnect 10 times, if you keep dropping, you have to get marked as leaver.</li>
	<li>Any team has the right to pause the game for up to 5 minutes combined. You may pause for as long as you like if both teams agree on it. But keep in mind, you can only pause 10 times overall per team for at most 5 minutes.</li>
	<li>The host of the lobby is always shown on the match page. That player has to create the lobby with the correct password and the following settings:
		<ol>
			<li>If you are playing in Europe, the Luxembourg server should be used by default, except if all players (10/10) agree on another one,</li>
			<li>Spectators are always disabled, are not allowed and should be kicked instantly</li>
			<li>If you are playing Captains Mode, "random first-pick" is always used</li>
		</ol>
	</li>
	<li>In the lobby:
		<ol>
			<li>All players have to join the correct slots, as shown on the match page.
				<ol>
					<li>Switching slots is not allowed! (especially not in Captains Mode)</li>
				</ol>
			</li>
			<li>When players do not show up:
				<ol>
					<li>Try contacting them via STEAM first (the link to their profile is on the match page)</li>
					<li>After 5 minutes of waiting, the match can be cancelled</li>
				</ol>
			</li>
		</ol>
	</li>
	<li>Captains-Mode (CM):
		<ol>
			<li>The captain (Blue/Pink) decides who plays which hero in their team. Of course, the selection needs to be reasonable and should be discussed with other members of the team first (e.g. whether they can play a specific hero). </li>
		</ol>
	</li>
</ol>
<h3>Section 3: Streaming</h3>
<ol>
	<script type="text/javascript"
		src="http://cdn.dev.skype.com/uri/skype-uri.js"></script>
	<li>Basically, there is no streaming allowed, unless you get a permission from SowlEye (ki4dy_sowleye @ Skype).
<br>If you want permission, click the button below and talk to the person in charge.
	</li>
	<span id="SkypeButton_Chat_ki4dy_sowleye_1"> <script
			type="text/javascript">
    Skype.ui({
      "name": "chat",
      "element": "SkypeButton_Chat_ki4dy_sowleye_1",
      "participants": ["ki4dy_sowleye"],
      "imageSize": 32
    });
  </script>
	</span>
</ol>
<h3>Section 4: Events</h3>
<p>Winning an event grants each of the team's members +75 ELO points.</p>
<ol>
	<li>After the creation of a lobby, wait 5 minutes before you start the game. The two reasons for this:</li>
	<ol>
		<li>You can organize yourself to get on a Teamspeak server etc. and discuss beforehand,</li>
		<li>Our streamer is able to join the game in time.</li>
	</ol>
	<li>Every game has to last at least 15 minutes. This means that you can forfeit the game by writing "gg" in All-chat after the game has lasted for at least 15 minutes.</li>
	<li>The rules concerning flaming, spamming and leaving are stricter during events, so you should keep that in mind.</li>
	<li>If both teams are unable to play, the game has to be cancelled. However, if one of the two teams can play and the other one can't (e.g. because of missing players), then the team with 5 ready players wins the game or the tournament..</li>
</ol>

@stop