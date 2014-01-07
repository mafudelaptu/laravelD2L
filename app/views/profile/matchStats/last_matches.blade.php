<div class="customH2">Last<span>Matches</span></div>

@if(!empty($lastMatches) && count($lastMatches) > 0)
	<table class="table table-striped">
		<thead>
			<tr align="center">
				<th></th>
				<th>Result</th>
				<th>MatchID</th>
				<th>Mode</th>
			</tr>
		</thead>
		
		<tbody>
		  @foreach($lastMatches as $key=>$v)
		  	{{--dd($v)--}}
		  	@if($v['team_won_id'] == $v['team_id'])
		  		<?php 
		  			$statusClass = "success";
		  			$result = "won";
		  		 ?>
		  		@if(!$lastMatchesLeaverArray[$v['id']])
		  			<?php $vorzeichen = "+"; ?>
		  		@endif
		  		
		  	@else
		  		@if($v['canceled'] == 1)
		  			<?php 
			  			$statusClass = "success";
			  		 ?>
		  		@else
		  			<?php 
		  			$statusClass = "danger";
		  			$result = "lost";
		  		 ?>
		  		@endif
		  		<?php $vorzeichen = ""; ?>
		  	@endif
		  	
		  	@if($v['pointschange'] == "" && $v['team_id'] == $v['team_id'])
		  		<?php $v['pointschange'] = "+0"; ?>
		  	@elseif( $v['pointschange'] == "" && $v['team_id'] != $v['team_id'])
		  		<?php $v['pointschange'] = "-0"; ?>
		  	@endif
			
		  	<tr>
				<td style="text-align:center">
					@include("icons.matchtype", array("matchtype_id"=>$v['matchtype_id'], "matchtype"=>$v['matchtype']))
				</td>
				<td><span class="label label-{{$statusClass}}">
					@if($v['canceled'] == 1)
		  				@include("icons.match_canceled"); 
		  			@else
		  				{{$result}} 
		  			@endif
					
					{{$vorzeichen}}{{$v['pointschange']}}</span>
					@include("icons.leaver", array("leaver"=>$lastMatchesLeaverArray[$v['id']]))
				</td>
				<td>
					{{HTML::link("match/".$v['id'], $v['id']);}}
				</td>
				<td><span class="t" title="{{$v['matchmode']}}">{{$v['mm_shortcut']}}</span></td>
			</tr>
		  @endforeach
		</tbody>
	</table>
	<p>
	<a href="{{URL::to("lastMatches")}}">View All Matches <i class="icon-double-angle-right"></i></a>
	</p>
@else
	<div class="alert alert-warning">No Matches found!</div>
@endif