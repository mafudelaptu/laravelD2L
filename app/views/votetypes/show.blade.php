@extends('layouts.scaffold')

@section('main')

<h1>Show Votetype</h1>

<p>{{ link_to_route('votetypes.index', 'Return to all votetypes') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Active</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $votetype->name }}}</td>
					<td>{{{ $votetype->active }}}</td>
                    <td>{{ link_to_route('votetypes.edit', 'Edit', array($votetype->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('votetypes.destroy', $votetype->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
