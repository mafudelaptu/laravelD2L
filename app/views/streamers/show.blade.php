@extends('layouts.scaffold')

@section('main')

<h1>Show Streamer</h1>

<p>{{ link_to_route('streamers.index', 'Return to all streamers') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Channelname</th>
				<th>Linked_to_user</th>
				<th>Lang</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $streamer->channelname }}}</td>
					<td>{{{ $streamer->linked_to_user }}}</td>
					<td>{{{ $streamer->lang }}}</td>
                    <td>{{ link_to_route('streamers.edit', 'Edit', array($streamer->channelname), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('streamers.destroy', $streamer->channelname))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
