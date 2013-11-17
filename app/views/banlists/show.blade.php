@extends('layouts.scaffold')

@section('main')

<h1>Show Banlist</h1>

<p>{{ link_to_route('banlists.index', 'Return to all banlists') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>User_id</th>
				<th>Banned_at</th>
				<th>Banned_until</th>
				<th>Banlistreason_id</th>
				<th>Display</th>
				<th>BannedBy</th>
				<th>Reason</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $banlist->user_id }}}</td>
					<td>{{{ $banlist->banned_at }}}</td>
					<td>{{{ $banlist->banned_until }}}</td>
					<td>{{{ $banlist->banlistreason_id }}}</td>
					<td>{{{ $banlist->display }}}</td>
					<td>{{{ $banlist->bannedBy }}}</td>
					<td>{{{ $banlist->reason }}}</td>
                    <td>{{ link_to_route('banlists.edit', 'Edit', array($banlist->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('banlists.destroy', $banlist->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
