
@if($data['nextSkillbracket'] != "")

<div class="well well-small" style="padding-bottom: 14px; margin:0; ">
<div class="reqNeededHeading">
	Requirements you need for next Skill-Bracket: <green>{{$data['nextSkillbracket']}}</green>
</div>
<div class="row">
	<div class="col-sm-3">
		<div align="center" style="color:#b94a48"><span style="font-size:12px; font-weight:bold">{{$data['nextTotalGames']}}+</span> <i class="icon-gamepad"></i></div>
		<div class="reqNeededStatsDesc">Games played</div>
		@if( $data['nextTotalGames'] > 0 && $data['neededGames'] > 0)
			<?php 
				$width = (($data['currentGames']/$data['nextTotalGames'])*100);
			?>
			@if( $data['currentGames']==0 || $width < 15)
			<?php 
				$blackStyle = "color:black;";
			 ?>
			@else
				<?php 
				$blackStyle = "";
			 	?>
			@endif
			
			<div class="progress" style="margin:0;">
			  <div class="progress-bar" style="{{$blackStyle}} line-height: 21px; width: {{$width}}%;">{{$data['currentGames']}}/{{$data['nextTotalGames']}}</div>
			</div>
		@else
			<div class="progress">
			  <div class="progress-bar progress-bar-success" style="line-height: 21px; width: 100%;">OK</div>
			</div>
		@endif
	</div>
	<div class="col-sm-3">
		<div align="center"><span style="color:#f89406;font-weight:bold; font-size:12px;">{{$data['nextWinRate']}}%+</span></div>
		<div class="reqNeededStatsDesc">Winrate</div>
		@if( $data['neededWinRate'] > 0 && $data['nextWinRate'] > 0)
			<?php 
				$width = (($data['currentWinRate']/$data['nextWinRate'])*100);
			?>

			@if( $data['currentWinRate']==0 || $width < 15)
			<?php 
				$blackStyle = "color:black;";
				$descStyle = "width:111px;";
			 ?>
			@else
				<?php 
				$blackStyle = "";
				$descStyle = "";
			 ?>
			@endif
			<div class="progress" style="margin:0;">
			  <div class="progress-bar" style="{{$blackStyle}} line-height: 21px; width: {{$width}}%;"><div style="{$descStyle}">needed +{{$data['neededWinRate']}} ({{$data['nextWinRate']}} %)</div></div>
			</div>
		@else
			<div class="progress" style="margin:0;">
			  <div class="progress-bar progress-bar-success" style="line-height: 21px; width:100%;">OK</div>
			</div>
		@endif
	</div>
	<div class="col-sm-3">
		<div align="center"><i class="icon-thumbs-up"></i><span style="font-size:12px; font-weight:bold"> > 0</span></div>
		<div class="reqNeededStatsDesc">Credits</div>
		@if( $data['neededCredits'] > 0)
		<?php 
			$width = (( ($data['currentCredits']+20)/($data['neededCredits']+20) )*100);
		 ?>
			@if( $data['currentCredits']==-20 || $width < 15)
				<?php 
				$blackStyle = "color:black;";
			 ?>
			@else
				<?php 
				$blackStyle = "";
			 ?>
			@endif
			<div class="progress" style="margin:0;">
			  <div class="progress-bar" style="{{$blackStyle}} line-height: 21px; width: {{$width}}%;">-{{$data['neededCredits']}}</div>
			</div>
		@else
			<div class="progress" style="margin:0;">
			  <div class="progress-bar progress-bar-success" style="line-height: 21px; width:100%;">OK</div>
			</div>
		@endif
	</div>
	<div class="col-sm-3">
		<div align="center" style="color:#f89406;"><i class="icon-warning-sign"></i>&nbsp;<span class="t" title="active warns">{{$data['activeWarns']}}</span>-<span class="t" title="total games needed to fullfill the criteria">{{$data['neededWarnTotalGames']}}</span></div>
		<div class="reqNeededStatsDesc">Warns</div>
		@if( $data['neededWarnGames'] > 0)
			<?php 
				$width = (($data['currentGames']/$data['neededWarnTotalGames'])*100);
			 ?>
			@if( $width < 15)
				<?php 
				$blackStyle = "color:black;";
			 ?>
			@else
				<?php 
				$blackStyle = "";
			 ?>
			@endif
			<div class="progress" style="margin:0;">
			  <div class="progress-bar" style="{{$blackStyle}} line-height: 21px; width: {{$width}}%;">{{$data['currentGames']}}/{{$data['neededWarnTotalGames']}}</div>
			</div>
		@else
			<div class="progress" style="margin:0;">
			  <div class="progress-bar progress-bar-success" style="line-height: 21px; width:100%;">OK</div>
			</div>
		@endif
	</div>
</div>
</div>

@endif