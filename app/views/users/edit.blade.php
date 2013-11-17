@extends('layouts.scaffold')

@section('main')

<h1>Edit User</h1>
{{ Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) }}
	<ul>
        <li>
            {{ Form::label('steam_id', 'Steam_id:') }}
            {{ Form::text('steam_id') }}
        </li>

        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('avatar', 'Avatar:') }}
            {{ Form::text('avatar') }}
        </li>

        <li>
            {{ Form::label('avatarMed', 'AvatarMed:') }}
            {{ Form::text('avatarMed') }}
        </li>

        <li>
            {{ Form::label('avatarFull', 'AvatarFull:') }}
            {{ Form::text('avatarFull') }}
        </li>

        <li>
            {{ Form::label('admin', 'Admin:') }}
            {{ Form::input('number', 'admin') }}
        </li>

        <li>
            {{ Form::label('hash', 'Hash:') }}
            {{ Form::text('hash') }}
        </li>

        <li>
            {{ Form::label('basePoints', 'BasePoints:') }}
            {{ Form::text('basePoints') }}
        </li>

        <li>
            {{ Form::label('basePointsUpdatedTimestamp', 'BasePointsUpdatedTimestamp:') }}
            {{ Form::input('number', 'basePointsUpdatedTimestamp') }}
        </li>

        <li>
            {{ Form::label('resetStats', 'ResetStats:') }}
            {{ Form::input('number', 'resetStats') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('users.show', 'Cancel', $user->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
