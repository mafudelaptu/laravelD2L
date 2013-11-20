@extends('layouts.scaffold')

@section('main')

<h1>Show Region</h1>

<p>{{ link_to_route('regions.index', 'Return to all regions') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Active</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $region->name }}}</td>
					<td>{{{ $region->active }}}</td>
                    <td>{{ link_to_route('regions.edit', 'Edit', array($region->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('regions.destroy', $region->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
