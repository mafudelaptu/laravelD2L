
<div class="label label-default">
	{{$points}}
</div>
@if($matchState == "closed")
	@if(strpos($pointsChange, '-'))
		<?php 
			$textClass = "danger";
		?>
	@else
		<?php 
			$textClass = "success";
		?>
	@endif
	<span class="text-{{$textClass}}">
		{{$pointChange}}
	</span>
@else
	<span class="text-success">
		+{{$winPoints}}
	</span>
	/
	<span class="text-danger">
		-{{$losePoints}}
	</span>
@endif
