<div class="row" align="center">
	<div class="col-sm-2 col-sm-offset-1">
		<div><strong>WINS</strong></div>
		<div><span class="text-success">{{$data['Wins']}}</span></div>
	</div>
	<div class="col-sm-2">
		<div><strong>LOSSES</strong></div>
		<div><span class="text-danger">{{$data['Losses']}}</span></div>
	</div>
	<div class="col-sm-2">
		<div><strong>WINRATE</strong></div>
		<div><span class="text-warning">{{$data['WinRate']}}%</span></div>
	</div>
	<div class="col-sm-2">
		<div><strong>LEAVES</strong></div>
		<div><span class="">{{$data['Leaves']}}</span></div>
	</div>
	<div class="col-sm-2">
		<div><strong>WARNS</strong></div>
		<div>{{$activeWarns}}&nbsp;<span class="t muted" title="total warns">({{$warns}})</span></div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		@include("prototypes.skillbracketImage", array("skillbracket_id"=>$skillbracket['skillbrackettype_id'], "skillbracket"=>$skillbracket['skillbracket']))
	</div>
	<div class="col-sm-6 fontMich" align="center">
		<h4>Points</h4>
		<div style="font-size:50px; line-height: 50px;"><strong>{{$points}}</strong></div>
		<h4 style="margin-top:20px;">Ranking</h4>
		@if(  $data['Ranking'] == 0)
			<?php $data['Ranking'] = "unranked";?>
		@else
			<?php $data['Ranking'] .= ".";?>
		@endif
		<div style="font-size:40px;"><strong>{{$data['Ranking']}}</strong></div>
	</div>
</div>
