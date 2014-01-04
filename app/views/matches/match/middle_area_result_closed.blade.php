

@if($team_won_id == 1)
	<?php
		$alertClass = "success";
		$team = $team[1];
	?>
@else
	<?php 
		$alertClass = "danger";
		$team = $team[2];
	?>
@endif

<div class="alert alert-{{$alertClass}} text-center h3" style="text-transform: uppercase;">
	{{$team}} WON
</div>