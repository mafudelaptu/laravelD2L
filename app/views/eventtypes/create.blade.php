@extends('layouts.scaffold')

@section('main')

<h1>Create Eventtype</h1>

{{ Form::open(array('route' => 'eventtypes.store')) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('matchmode_id', 'Matchmode_id:') }}
            {{ Form::input('number', 'matchmode_id') }}
        </li>

        <li>
            {{ Form::label('matchtype_id', 'Matchtype_id:') }}
            {{ Form::input('number', 'matchtype_id') }}
        </li>

        <li>
            {{ Form::label('tournamenttype_id', 'Tournamenttype_id:') }}
            {{ Form::input('number', 'tournamenttype_id') }}
        </li>

        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description') }}
        </li>

        <li>
            {{ Form::label('min_submissions', 'Min_submissions:') }}
            {{ Form::input('number', 'min_submissions') }}
        </li>

        <li>
            {{ Form::label('start_time', 'Start_time:') }}
            {{ Form::text('start_time') }}
        </li>

        <li>
            {{ Form::label('start_day', 'Start_day:') }}
            {{ Form::text('start_day') }}
        </li>

        <li>
            {{ Form::label('region_id', 'Region_id:') }}
            {{ Form::input('number', 'region_id') }}
        </li>

        <li>
            {{ Form::label('active', 'Active:') }}
            {{ Form::input('number', 'active') }}
        </li>

        <li>
            {{ Form::label('prizetype_id', 'Prizetype_id:') }}
            {{ Form::input('number', 'prizetype_id') }}
        </li>

        <li>
            {{ Form::label('eventrequirement_id', 'Eventrequirement_id:') }}
            {{ Form::input('number', 'eventrequirement_id') }}
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


