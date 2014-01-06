<?php 
	$textClass = "";
	$iconClass = "";
	$titleText = "";
	$titleName = "";
	$border = GlobalSetting::getCreditBorders();
 ?>
	
@if ($credits >= $border['bronze'] && $credits < $border['silver'])
	{{-- */ $textClass = "text-bronze"; /*--}}
@elseif ($credits >= $border['silver'] && $credits < $border['gold'])
	{{-- */$textClass = "text-silver"; /*--}}
@elseif ($credits >= $border['gold'])
	{{-- */$textClass = "text-gold"; /*--}}
@endif

@if( strlen($username) >= $truncateValue && $truncateValue != 0)
	{{-- */$titleName = $username; /*--}}
@endif

<span class="t {{$textClass}}" title="{{$titleName}}">

	{{-- */$titleText = "earned Creditpoints: $credits"; /*--}}
	<a href="profile/{{$user_id}}" target="_blank">
		@if($avatar != "")
			<img src="{{$avatar}}" alt="Avatar">&nbsp;
		@endif
			@if($truncateValue > 0)
			{{Str::limit($username, $truncateValue)}}
		@else
			{{$username}}
		@endif
	</a>
	@if( $credits >= $border['bronze'])
	<span class="t" title="{{$titleText}}">
		@include("icons.credit")
	</span>
	@endif
</span>