<div class="customH2">
	Live<span>Streams</span>
</div>

<div style="background-color: #292929; color:#fff; padding:0 15px 5px">
@if(is_array($data) && count($data) > 0)
	@if(is_array($data['featured']) && count($data['featured']) > 0)
	<div align="center">OFFICIAL</div>
		@foreach($data['featured'] as $k=>$v)
			@include("home.liveStreams.streamer_row")
		@endforeach
	@endif
	@if(is_array($data['player']) && count($data['player']) > 0)
	<div align="center">COMMUNITY</div>
		@foreach($data['player'] as $k=>$v)
			@include("home.liveStreams.streamer_row")
		@endforeach
	@endif
@else
	<div align="center">no Live-Streams now</div>
@endif
</div>