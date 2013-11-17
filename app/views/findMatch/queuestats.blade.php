<h4>Queue statistics</h4>
@if(!empty($data))
<div class="row">
	<div class="col-sm-3">
		<div class="row">
			<div class="col-sm-3" align="center">
				<i class="fa fa-users fa-3x" style="color: #3a87ad"></i>
			</div>
			<div class="col-sm-9">
				<div class="statsNumber">{{$data->queueCount}}</div>
				<div class="statsDesc">Players in Queue</div>
			</div>
		</div>

	</div>

	<div class="col-sm-3">
		<div class="row">
			<div class="col-sm-3" align="center">
				<i class="fa fa-gamepad fa-3x" style="color: #b94a48"></i>
			</div>
			<div class="col-sm-9">
				<div class="statsNumber">
					@if(!empty($data->openMatches))
					<a href="openMatches">{$data->openMatches} (live)</a> 
					@else
					0
					@endif
				</div>
				<div class="statsDesc">Players in Match</div>
			</div>
		</div>

	</div>

	@if(!empty($data->maxMatchmode))
	<div class="col-sm-3">
		<div class="row">
			<div class="col-sm-3" align="center">
				<i class="fa fa-cog fa-3x" style="color: #f89406"></i>
			</div>
			<div class="col-sm-9">
				<div class="statsNumber">{{$data->maxMatchmode->name}}
					({{$data->maxMatchmode->count}})</div>
					<div class="statsDesc">Popular Matchmode now</div>
				</div>
			</div>
		</div>
	</div>
	@endif
	@if(!empty($data->maxRegion))}
	<div class="col-sm-3">
		<div class="row">
			<div class="col-sm-3" style="line-height: 45px;" align="center">
				<i class="fa fa-globe fa-3x" style="color: #468847"></i>
			</div>
			<div class="col-sm-9">
				<div class="statsNumber">{$data->maxRegion->name}
					({$data->maxRegion->count})</div>
					<div class="statsDesc">Popular Region now</div>
				</div>
			</div>

		</div>
		
	</div>
	@endif
</div>
@endif
