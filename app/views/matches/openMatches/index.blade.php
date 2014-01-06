@section("content")
<div class="page-header">
	<h1>{{$heading}}</h1>
</div>

@if (!empty($data) && !empty($submitCountsArray))
<table id="openMatchesTable"
	class="table table-striped openMatchesTable" cellpadding="0" cellspacing="0"
	border="0">
	<thead>
		<tr align="center">
			<th></th>
			<th></th>
			<th>Date</th>
			<th>MatchID</th>
			<th>Mode</th>
			<th>Submissions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k => $v)
		<?php 
			if($v->submitted == "1"){
				$submittedClass = "";
				$submittedIcon = "";
				$submittedTitle = "";
				$tableClass = "";
			}
			else{
				$submittedClass = "text-danger t";
				$submittedIcon = View::make('icons.notSubmitted')->render();
				$submittedTitle = "you have to submit a matchresult!";
				$tableClass = "danger";
			}

			$matchHref = URL::to("match/".$v->id);
		 ?>

		<tr class="{{$tableClass}}">
			<td><span class="{{$submittedClass}}" title="{{$submittedTitle}}">{{$submittedIcon}}</span></td>
			<td>@include("icons.matchtype", array("matchtype_id"=>$v->matchtype_id, "matchtype"=>$v->matchtype))</td>
			<td><span class="timeago" title="{{$v->created_at}}" datasort="{{$v->created_at}}">{{$v->created_at}}</span></td>
			<td><a href="{{$matchHref}}">{{$v->id}}</a></td>
			<td><span class="t badge badge-info" title="{{$v->matchmode}}">{{$v->mm_shortcut}}</span></td>
			<td><span class="label label-default">{{$submitCountsArray[$v->id]}}</span></td>
		</tr>

		@endforeach
	</tbody>
</table>
<br> <!-- Scrollbalken workaround -->
@else
<div class="alert alert-warning"> 
		no open matches
</div>
@endif
@stop