@extends('layouts.scaffold')

@section('main')

<h1>All Regions</h1>

<p>{{ link_to_route('regions.create', 'Add new region') }}</p>

@if ($regions->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Active</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($regions as $region)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no regions
@endif

@stop
