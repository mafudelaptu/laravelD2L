<ul class="nav nav-tabs">
@foreach($matchtypes as $key => $type)
	@if($key === 0)
		<?php $active = "active"; ?>
	@else
		<?php $active = ""; ?>
	@endif
  <li class="{{$active}}"><a href="#{{$type->id}}" data-toggle="tab">{{$type->name}}</a></li>
@endforeach
</ul>

<div class="tab-content">
@foreach($matchtypes as $key => $type)
	@if($key === 0)
		<?php $active = "active"; ?>
	@else
		<?php $active = ""; ?>
	@endif
  <div class="tab-pane {{$active}}" id="{{$type->id}}">
	@include("profile.userInfo.lvlUpinfo", array("data"=>$nextSkillbracket[$type->id]))
	
	@include("profile.userStats.stats", array("points"=>$points[$type->id], "data"=>$stats[$type->id], "skillbracket"=>$skillbracket[$type->id], "activeWarns"=>$activeBansCount, "warns"=>$allBansCount))

	@include("profile/graphs/winRateTrend")
  </div>
@endforeach
</div>

