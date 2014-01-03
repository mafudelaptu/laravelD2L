<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
	aria-hidden="true">×</button>
	<h3 id="myModalCancelMatchLabel">Cancel Match</h3>
</div>

<div class="modal-body">
	<div class="alert alert-warn">
		<h4>Warning:</h4>
		you can't change your submission afterwards, please be sure you
		submit the right reason!
	</div>

	<div class="control-group">
		<label class="control-label" for="checkWinLose">Reason:</label>
		<div class="controls" id="checkWinLoseCheckboxDiv">
			<div class="btn-group" data-toggle="buttons-radio"
			id="checkGroup">
			<button type="button" class="btn active"
			onclick="$('#leaverCancelMatchPannelArea').toggle();" value="2">couldn't play Match/Match is broken!</button>
			<button type="button" class="btn"
			onclick="setWinLoseValue(this);$('#leaverCancelMatchPannelArea').toggle();" value="1">Player didn't join the match</button>

		</div>
		<div id="checkErrorDiv"></div>
	</div>
</div>
<div id="leaverCancelMatchPannelArea" style="display:none">

	<h4>Select Player, who didn't join the Match</h4>
	<div id="leaverCancelMatchPannel">
		@for($i=0; $i<2; $i++)
		<div class="pull-left" style="width:50%">
			@foreach($players[$i] as $player)
			@if(Auth::user()->id == $player->user_id)
			<?php 
			$disabled = "disabled";
			?>
			@else
			<?php 
			$disabled = "";
			?>
			@endif
			<label class="checkbox" id="label_{{$player['user_id']}}"> 
				<input type="checkbox"
				value="{{$player['user_id']}}"
				id="player{$v.SteamID}"
				name="player{{$player['user_id']}}" {{$disabled}}>
				<img alt="Avatar" src="{{$player['avatar']}}" width="25" height="25">
				{{$player['name']}}
			</label>

			@endforeach
		</div>
		@endfor
	</div>
</div>
</div>
<div class="modal-footer">
	<button id="myModalCancelButton" class="btn" data-dismiss="modal"
	aria-hidden="true">Back</button>
	<button type="button" id="submitCancelButton"
	class="btn btn-success">Cancel Match!</button>
</div>