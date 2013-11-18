@section('content')

    <h1>{{$heading}}</h1>
{{-- hidden values for js --}}
{{Form::hidden('jCM', GlobalSetting::getJustCM());}}
<ul class="nav nav-tabs nav-justified">
	<?php $i=1; ?>
	@foreach($matchtypes as $mt)
		@if($i==1)
			<?php $active="active"; ?>
		@else
			<?php $active=""; ?>
		@endif
		<li class="{{$active}}"><a href="#mtTab{{$mt->id}}" data-toggle="tab">{{$mt->name}}</a></li>
	<?php $i++; ?>
	@endforeach
</ul>
<div class="tab-content">
	<?php $i=1; ?>
	@foreach($matchtypes as $mt)
		@if($i==1)
			<?php $active="active"; ?>
		@else
			<?php $active=""; ?>
		@endif
		<div class="tab-pane {{$active}}" id="mtTab{{$mt->id}}">
			
			@if($mt->id == 1)
				@include("findMatch.5vs5Single.index")
			@elseif($mt->id == 2)
				@include("findMatch.1vs1.index")
			@elseif($mt->id == 3)
				@include("findMatch.5vs5Team.index")
			@endif
			<hr>
		</div>

	<?php $i++; ?>
	@endforeach
</div>
@stop