<div class="customH2">
	Warns<span>History</span>
</div>

@if(!empty($data))
<table class="table table-striped" id="warnHistoryTable">
<thead>
<tr>
	<th>Warned At</th>
	<th>In Prison Until</th>
	<th>Warn Expires At</th>
	<th>Warned By</th>
	<th>Reason</th>
	<th>Active</th>
</tr>
</thead>
<tbody>
	@foreach($data as $k => $v)
		@if($v->display == 1)
		<?php 
			$active = "active";
			$activeClass = "success";
		 ?>
		 @else
		 	<?php 
			$active = "";
			$activeClass = "muted";
		 ?>
		 @endif
	<tr class="{{$activeClass}}">
		<td>{{$v->created_at}}</td>
		<td>{{$v->banned_until}}</td>
		<td>{{$v->expires}}</td>
		<td>{{$v->reason}}
			@if($v->bannedBy > 0)
			 - <a href="{{URL::to('profile/$v->bannedBy')}}" target="_blank"><img src="{{$v->bannedByAvatar}}" alt="{{$v->bannedByName}}'s Avatar">{{$v->bannedByName}}</a>
			@endif
		</td>
		<td>{{$v->banReasonText}}</td>
		<td>{{$active}}</td>
	</tr>
	@endforeach
</tbody>
</table>
@else
<div class="alert alert-warning">no warns found!</div>
@endif