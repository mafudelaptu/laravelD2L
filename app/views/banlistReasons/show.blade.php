@extends('layouts.scaffold')

@section('main')

<h1>Show BanlistReason</h1>

<p>{{ link_to_route('banlistReasons.index', 'Return to all banlistReasons') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $banlistReason->name }}}</td>
                    <td>{{ link_to_route('banlistReasons.edit', 'Edit', array($banlistReason->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('banlistReasons.destroy', $banlistReason->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
