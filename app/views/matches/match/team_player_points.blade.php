
<div class="label label-default">
	{{$points}}
</div>
@if($matchState == "closed")
	
	@if(strpos($pointsChange, '-') === 0)
		<?php 
			$textClass = "danger";
			$textAddition = "";
		?>
	@else
		<?php 
			$textClass = "success";
			$textAddition = "+";
		?>
	@endif
	<span class="text-{{$textClass}}">
		{{$textAddition}}{{$pointsChange}}
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
