@extends('layouts.scaffold')

@section('main')

<h1>All Users</h1>

<p>{{ link_to_route('users.create', 'Add new user') }}</p>

@if ($users->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Steam_id</th>
				<th>Name</th>
				<th>Avatar</th>
				<th>AvatarMed</th>
				<th>AvatarFull</th>
				<th>Admin</th>
				<th>Hash</th>
				<th>BasePoints</th>
				<th>BasePointsUpdatedTimestamp</th>
				<th>ResetStats</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{{ $user->steam_id }}}</td>
					<td>{{{ $user->name }}}</td>
					<td>{{{ $user->avatar }}}</td>
					<td>{{{ $user->avatarMed }}}</td>
					<td>{{{ $user->avatarFull }}}</td>
					<td>{{{ $user->admin }}}</td>
					<td>{{{ $user->hash }}}</td>
					<td>{{{ $user->basePoints }}}</td>
					<td>{{{ $user->basePointsUpdatedTimestamp }}}</td>
					<td>{{{ $user->resetStats }}}</td>
                    <td>{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no users
@endif

@stop
