@extends('layouts.scaffold')

@section('main')

<h1>Show Eventtype</h1>

<p>{{ link_to_route('eventtypes.index', 'Return to all eventtypes') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Matchmode_id</th>
				<th>Matchtype_id</th>
				<th>Tournamenttype_id</th>
				<th>Description</th>
				<th>Min_submissions</th>
				<th>Start_time</th>
				<th>Start_day</th>
				<th>Region_id</th>
				<th>Active</th>
				<th>Prizetype_id</th>
				<th>Eventrequirement_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $eventtype->name }}}</td>
					<td>{{{ $eventtype->matchmode_id }}}</td>
					<td>{{{ $eventtype->matchtype_id }}}</td>
					<td>{{{ $eventtype->tournamenttype_id }}}</td>
					<td>{{{ $eventtype->description }}}</td>
					<td>{{{ $eventtype->min_submissions }}}</td>
					<td>{{{ $eventtype->start_time }}}</td>
					<td>{{{ $eventtype->start_day }}}</td>
					<td>{{{ $eventtype->region_id }}}</td>
					<td>{{{ $eventtype->active }}}</td>
					<td>{{{ $eventtype->prizetype_id }}}</td>
					<td>{{{ $eventtype->eventrequirement_id }}}</td>
                    <td>{{ link_to_route('eventtypes.edit', 'Edit', array($eventtype->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('eventtypes.destroy', $eventtype->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
