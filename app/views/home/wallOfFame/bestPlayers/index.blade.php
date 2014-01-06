<div class="custom2H2">
	Best Players
</div>

@if(!empty($data))
		<table class="table table-striped">
			<thead>
				<tr align="center">
					<th>#</th>
					<th>Points</th>
					<th>Player</th>
					<th>Win Rate</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $k => $v)
				<tr
					class="{include file='prototypes/positionTrClass.tpl' position=$smarty.foreach.bestPlayers_array.iteration}">
					<td><strong>{$smarty.foreach.bestPlayers_array.iteration}.</strong></td>
					<td>{$v.Rank}</td>
					<td><img src="{$v.Avatar}">
						@include("prototypes.username", array("username"=>$v->name, "credits"=>$creditsArray[$v->id], "user_id"=>$v->id))
						</td>
					<td><span class="text-warning">{$v.WinRate}%</span></td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<p>
			<a href="{{URL::to('ladder')}}">View All Rankings <i
				class="icon-double-angle-right"></i></a>
		</p>
@else
		<div class="alert fade in">No Rankings found!</div>
@endif