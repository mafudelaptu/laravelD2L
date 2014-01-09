@extends('layouts.scaffold')

@section('main')

<h1>All Globalsettings</h1>

<p>{{ link_to_route('globalsettings.create', 'Add new globalsetting') }}</p>

@if ($globalsettings->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Value</th>
				<th>Active</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($globalsettings as $globalsetting)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no globalsettings
@endif

@stop
