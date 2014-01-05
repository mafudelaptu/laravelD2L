<div class="customH2">
	Ranking<span>s</span>
</div>
@if(!empty($bestRankings))
<table class="table table-striped">
	<thead>
		<tr align="center">
			<th>Rank</th>
			<th>Type</th>
			<th>Mode</th>
			<th>Points</th>
			<th>Wins</th>
			<th>Losses</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bestRankings as $key => $v)
			<tr>
				<td><strong>{{$v['position']}}.</strong></td>
				<td style="text-align:center">
					@include("icons.matchtype", array("matchtype_id"=>$v['matchtype_id'], "matchtype"=>$v['matchtype_id']))
				</td>
				<td><span class="t" title="{{$v['matchmode']}}">{{$v['mm_shortcut']}}</span></td>
				<td>{{$v['Points']}}</td>
				<td class="text-success">{{$v['Wins']}}</td>
				<td class="text-error">{{$v['Losses']}}</td>
			</tr>
    	@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning">No Rankings found!</div>
@endif
<p>
<a href="ladder">View All Rankings <i class="icon-double-angle-right"></i></a></p>