<div class="customH2">Point<span>History</span></div>
<div class="row">
	<div class="col-sm-4">
		Matchtype:<select class="selectpicker"
			onchange="drawPointHistoryChart()" id="pointHistoryMTSelect">
			@if(!empty($matchtypes)) 
			@foreach($matchtypes as $k => $v)
				<option value="{{$v->id}}">{{$v->name}}</option> 
			@endforeach 
			@endif
		</select>
	</div>
	<div class="col-sm-4">
		Matchmode:<select class="selectpicker"
			onchange="drawPointHistoryChart()" id="pointHistoryMMSelect">
			@if(!empty($matchmodes))
				<option value="*">All Matchmodes</option> 
				@foreach($matchmodes as $k => $v) 
					<option value="{{$v->id}}">{{$v->name}}</option> 
				@endforeach 
			@endif
		</select>
	</div>
	<div class="col-sm-4">
	Count 
	<select class="selectpicker"
			onchange="drawPointHistoryChart()" id="pointHistoryCountSelect">
			
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="*">all Values</option>
		</select>
	</div>


</div>
<div id="pointHistoryChart"
	style="width: 100%; height: 300px; margin-top: 5px;">
	<!--     Chart -->
</div>