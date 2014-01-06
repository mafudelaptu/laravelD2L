@extends('layouts.scaffold')

@section('main')

<h1>Edit Streamer</h1>
{{ Form::model($streamer, array('method' => 'PATCH', 'route' => array('streamers.update', $streamer->channelname))) }}
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
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('streamers.show', 'Cancel', $streamer->channelname, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
