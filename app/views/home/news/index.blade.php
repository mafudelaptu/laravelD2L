@if(!empty($newsData) && !empty($newsData[0]))
	@foreach($newsData as $k => $v)
		<div class="custom2H2">
			{{$v->title}}
		</div>
		<div class="newsContent">
		{{$v->content}}
		</div>
	@endforeach
@else
	<div class="alert alert-warning">
		No active news!
	</div>
@endif