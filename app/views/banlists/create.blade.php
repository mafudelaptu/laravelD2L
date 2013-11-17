@extends('layouts.scaffold')

@section('main')

<h1>Create Banlist</h1>

{{ Form::open(array('route' => 'banlists.store')) }}
	<ul>
        <li>
            {{ Form::label('user_id', 'User_id:') }}
            {{ Form::text('user_id') }}
        </li>

        <li>
            {{ Form::label('banned_at', 'Banned_at:') }}
            {{ Form::text('banned_at') }}
        </li>

        <li>
            {{ Form::label('banned_until', 'Banned_until:') }}
            {{ Form::text('banned_until') }}
        </li>

        <li>
            {{ Form::label('banlistreason_id', 'Banlistreason_id:') }}
            {{ Form::input('number', 'banlistreason_id') }}
        </li>

        <li>
            {{ Form::label('display', 'Display:') }}
            {{ Form::input('number', 'display') }}
        </li>

        <li>
            {{ Form::label('bannedBy', 'BannedBy:') }}
            {{ Form::text('bannedBy') }}
        </li>

        <li>
            {{ Form::label('reason', 'Reason:') }}
            {{ Form::textarea('reason') }}
        </li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


