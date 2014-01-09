@extends('layouts.scaffold')

@section('main')

<h1>Show Globalsetting</h1>

<p>{{ link_to_route('globalsettings.index', 'Return to all globalsettings') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Value</th>
				<th>Active</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $globalsetting->name }}}</td>
					<td>{{{ $globalsetting->value }}}</td>
					<td>{{{ $globalsetting->active }}}</td>
                    <td>{{ link_to_route('globalsettings.edit', 'Edit', array($globalsetting->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('globalsettings.destroy', $globalsetting->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
