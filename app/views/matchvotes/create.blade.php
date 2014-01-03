@extends('layouts.scaffold')

@section('main')

<h1>Create Matchvote</h1>

{{ Form::open(array('route' => 'matchvotes.store')) }}
	<ul>
        <li>
            {{ Form::label('user_id', 'User_id:') }}
            {{ Form::text('user_id') }}
        </li>

        <li>
            {{ Form::label('match_id', 'Match_id:') }}
            {{ Form::input('number', 'match_id') }}
        </li>

        <li>
            {{ Form::label('vote_for_user', 'Vote_for_user:') }}
            {{ Form::text('vote_for_user') }}
        </li>

        <li>
            {{ Form::label('matchvotetype_id', 'Matchvotetype_id:') }}
            {{ Form::input('number', 'matchvotetype_id') }}
        </li>

        <li>
            {{ Form::label('reason', 'Reason:') }}
            {{ Form::input('number', 'reason') }}
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


