@extends('layouts.scaffold')

@section('main')

<h1>Show Pointtype</h1>

<p>{{ link_to_route('pointtypes.index', 'Return to all pointtypes') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Active</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $pointtype->name }}}</td>
					<td>{{{ $pointtype->active }}}</td>
                    <td>{{ link_to_route('pointtypes.edit', 'Edit', array($pointtype->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('pointtypes.destroy', $pointtype->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
