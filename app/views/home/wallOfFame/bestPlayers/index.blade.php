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
				<tr>
					<td><strong>{{($k+1)}}</strong></td>
					<td>{{$v->points}}</td>
					<td>
						@include("prototypes.username", array("username"=>$v->name, "avatar"=>$v->avatar, "credits"=>$v->credits, "user_id"=>$v->id, "truncateValue"=>20))
					</td>
					<td><span class="text-warning">{{$v['stats']['WinRate']}}%</span></td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<p>
			<a href="{{URL::to('ladder')}}">View All Rankings <i
				class="icon-double-angle-right"></i></a>
		</p>
@else
		<div class="alert alert-warning">No Rankings found!</div>
@endif