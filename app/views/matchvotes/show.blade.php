@extends('layouts.scaffold')

@section('main')

<h1>Show Matchvote</h1>

<p>{{ link_to_route('matchvotes.index', 'Return to all matchvotes') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>User_id</th>
				<th>Match_id</th>
				<th>Vote_for_user</th>
				<th>Matchvotetype_id</th>
				<th>Reason</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $matchvote->user_id }}}</td>
					<td>{{{ $matchvote->match_id }}}</td>
					<td>{{{ $matchvote->vote_for_user }}}</td>
					<td>{{{ $matchvote->matchvotetype_id }}}</td>
					<td>{{{ $matchvote->reason }}}</td>
                    <td>{{ link_to_route('matchvotes.edit', 'Edit', array($matchvote->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('matchvotes.destroy', $matchvote->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
