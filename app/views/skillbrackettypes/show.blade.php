@extends('layouts.scaffold')

@section('main')

<h1>Show Skillbrackettype</h1>

<p>{{ link_to_route('skillbrackettypes.index', 'Return to all skillbrackettypes') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Winpoints</th>
				<th>Losepoints</th>
				<th>Active</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $skillbrackettype->name }}}</td>
					<td>{{{ $skillbrackettype->winpoints }}}</td>
					<td>{{{ $skillbrackettype->losepoints }}}</td>
					<td>{{{ $skillbrackettype->active }}}</td>
                    <td>{{ link_to_route('skillbrackettypes.edit', 'Edit', array($skillbrackettype->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('skillbrackettypes.destroy', $skillbrackettype->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
