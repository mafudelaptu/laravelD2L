<div class="custom2H2">
	Last<span> Matches</span>
</div>
@if(count($data) > 0)
<form class="form-inline">
		<label class="control-label" for="lastMatchesPlayedSelectCategory">Filtered by:</label>
			<select name="lastMatchesPlayedSelectCategory"
				id="lastMatchesPlayedSelectCategory">
	
				<option value="0">All Matchmodes</option>
				@foreach($matchmodes as $k=>$mm)
					<option value="{{$mm->id}}">{{$mm->name}} ({{$mm->shortcut}})</option>
    			@endforeach
			</select>
</form>
<table class="table table-striped">
	<thead>
		<tr align="center">
			<th></th>
			<th>ID</th>
			<th>Mode</th>
			<th>Result</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		@if( $v->team_won_id == 1)
			<?php 
				$teamWon = "The Radiant";
				$labelClass = "success";
			?>
		@elseif($v->team_won_id == 2)
			<?php 
				$teamWon = "The Dire";
				$labelClass = "danger";
			?>
		@endif
		<?php 
			$matchHref = URL::to("match/".$v->id);
		 ?>
		<tr class="">
			<td style="text-align:center">
				@include("icons.matchtype", array("matchtype_id"=>$v->matchtype_id, "matchtype"=>$v->matchtype))
			</td>
			<td><a href="{{$matchHref}}">{{$v->id}}</a></td>
			<td><span class="t" title="{{$v->matchmode}}"><span class="badge badge-info">{{$v->mm_shortcut}}</span></td>
			<td><span class="label label-{{$labelClass}}">{{$teamWon}}</span></td>
		</tr>
		@endforeach
	</tbody>
</table>

@else
<div class="alert alert-warning">No Matches found!</div>
@endif