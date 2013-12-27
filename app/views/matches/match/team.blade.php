@if($team_id == 1)
	<?php $alertClass = "success"; ?>
@else
	<?php $alertClass = "danger"; ?>
@endif


<div class="match_team_header alert-{{$alertClass}}">
{{$team[$team_id]}}
</div>

@foreach($data as $player)
		
    @include("matches.match.team_player", array('playerdata' => $player))
    
@endforeach