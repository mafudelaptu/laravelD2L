@extends('layouts.scaffold')

@section('main')

<h1>Create Streamer</h1>

{{ Form::open(array('route' => 'streamers.store')) }}
	<ul>
        <li>
            {{ Form::label('channelname', 'Channelname:') }}
            {{ Form::text('channelname') }}
        </li>

        <li>
            {{ Form::label('linked_to_user', 'Linked_to_user:') }}
            {{ Form::text('linked_to_user') }}
        </li>

        <li>
            {{ Form::label('lang', 'Lang:') }}
            {{ Form::text('lang') }}
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


