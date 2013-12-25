@extends('layouts.scaffold')

@section('main')

<h1>Show Uservotecount</h1>

<p>{{ link_to_route('uservotecounts.index', 'Return to all uservotecounts') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>User_id</th>
				<th>Upvotes</th>
				<th>Downvotes</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $uservotecount->user_id }}}</td>
					<td>{{{ $uservotecount->upvotes }}}</td>
					<td>{{{ $uservotecount->downvotes }}}</td>
                    <td>{{ link_to_route('uservotecounts.edit', 'Edit', array($uservotecount->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('uservotecounts.destroy', $uservotecount->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
