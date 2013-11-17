@extends('layouts.scaffold')

@section('main')

<h1>All PermaBans</h1>

<p>{{ link_to_route('permaBans.create', 'Add new permaBan') }}</p>

@if ($permaBans->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>User_id</th>
				<th>Banlistreason_id</th>
				<th>Banned_at</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($permaBans as $permaBan)
				<tr>
					<td>{{{ $permaBan->user_id }}}</td>
					<td>{{{ $permaBan->banlistreason_id }}}</td>
					<td>{{{ $permaBan->banned_at }}}</td>
                    <td>{{ link_to_route('permaBans.edit', 'Edit', array($permaBan->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('permaBans.destroy', $permaBan->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no permaBans
@endif

@stop
