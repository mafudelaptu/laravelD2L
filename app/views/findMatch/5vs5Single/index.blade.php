
<div class="row">
	<div class="col-sm-2">
		5vs5
	</div>
	<div class="col-sm-10">
		@include("findMatch.queuestats", array("data" => $queueStats5vs5Single))
		<hr>

		<div class="row">
			<div class="col-sm-5" class="quickJoinArea">
				<div class="alert alert-info text-center">Join automaticly into <span class="badge label-info">CD</span>-Queue
				</div>
				@if(!$inMatch)
					<button type="button" class="btn btn-large btn-block btn-success" id="quickJoin5vs5Single">JOIN-CD</button>
				@else
					@include("findMatch.inMatchError")
				@endif
			</div>
			<div class="col-sm-2 text-center">
				<span class="h2">
					<br>
					OR
				</span>
			</div>
			<div class="col-sm-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">selected matchmodes</h3>
					</div>
					<div class="panel-body">
						<div id="selectedMatchmodesCheckboxes">
							@foreach($matchmodes as $mm)
							<?php 
							if(!empty($_COOKIE['selectedMatchmodes'])){
								if(in_array($mm->id, $_COOKIE['selectedMatchmodes'])){
									$badgeClass = "info";
									$checked = "checked='checked'";
								}
								else{
									$badgeClass = "default";
									$checked = "";
								}
							}
							else{
								$badgeClass = "default";
								$checked = "";
							}
							?>
							<label class="checkbox-inline">
								<input type="checkbox" value="{{$mm->id}}" name="selectedMatchmode" {{$checked}}><span class="badge badge-{{$badgeClass}} t" title="{{$mm->name}}">{{$mm->shortcut}}</span>
							</label>
							
							@endforeach
							
						</div>
					</div>
				</div>
				<div align="center">
					@if(GlobalSetting::getDuoJoin())
					<div class="btn-group">
						@if(!$inMatch)
						<button type="button" class="btn btn-lg btn-block" id="join5vs5SingleButton">
							<i class="fa fa-user"></i>&nbsp;Single-Join
						</button>
						<button class="btn btn-large t " id="duoJoin5vs5SingleButton" data-original-title=""> 
								<i class="fa fa-user"></i><i class="fa fa-user"></i>&nbsp;Duo-Join
								[Beta]
							</button>
						@else
							@include("findMatch.inMatchError")
						@endif
							
						
					</div>
					@else
						@if(!$inMatch)
						<button type="button" class="btn btn-lg btn-block" id="join5vs5SingleButton">
							<i class="fa fa-user"></i>&nbsp;Single-Join
						</button>
						@else
							@include("findMatch.inMatchError")
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
