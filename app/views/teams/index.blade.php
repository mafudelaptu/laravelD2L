@extends('layouts.scaffold')

@section('main')

<h1>All Teams</h1>

<p>{{ link_to_route('teams.create', 'Add new team') }}</p>

@if ($teams->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($teams as $team)
				<tr>
					<td>{{{ $team->name }}}</td>
                    <td>{{ link_to_route('teams.edit', 'Edit', array($team->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('teams.destroy', $team->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no teams
@endif

@stop
