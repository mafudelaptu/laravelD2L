@extends('layouts.scaffold')

@section('main')

<h1>All Pointtypes</h1>

<p>{{ link_to_route('pointtypes.create', 'Add new pointtype') }}</p>

@if ($pointtypes->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Active</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($pointtypes as $pointtype)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no pointtypes
@endif

@stop
