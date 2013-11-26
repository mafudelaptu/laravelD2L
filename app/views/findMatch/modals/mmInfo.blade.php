<div class="row">
	<div class="col-sm-6">
		@foreach($modes as $mode)
			{{ $mode->name }} <div class="label label-info">{{$mode->shortcut}}</div>
		@endforeach
	</div>
	<div class="col-sm-6"></div>
</div>