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
				<button type="button" class="btn btn-large btn-block btn-success" id="quickJoin5vs5Single">JOIN-CD</button>
			</div>
			<div class="col-sm-2 text-center">
				<span class="h2">
					<br>
					OR
				</span>
			</div>
			<div class="col-sm-5">
				<div class="row">
					<div class="col-sm-12" align="center"> <h4 class="media-heading">Selected Matchmode <a href="#myModalSelectMatchMode" class="btn btn-mini btn-inverse" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-pencil fa fa-white t" data-original-title="Customize selected Matchmodes"></i></a></h4>
						<div id="SingleQueueMatchModes">
							<span class="badge badge-info t" data-value="9" data-original-title="Captains Draft">CD</span>&nbsp;
						</div>
						<div id="SingleQueueMatchModesErrors">
						</div>
					</div>
				</div>
				<br>
				<div align="center">
					<div class="btn-group">

						<button class="btn btn-large" onclick="joinSingleQueue(false)">
							<i class="fa fa-user"></i>&nbsp;Single-Join
						</button>
						<button class="btn btn-large t " onclick="joinDuoSingleQueue2(false, false)" data-original-title=""> 
							<i class="fa fa-user"></i><i class="fa fa-user"></i>&nbsp;Duo-Join
							[Beta]
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
