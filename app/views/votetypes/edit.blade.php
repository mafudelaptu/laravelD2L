@extends('layouts.scaffold')

@section('main')

<h1>Edit Votetype</h1>
{{ Form::model($votetype, array('method' => 'PATCH', 'route' => array('votetypes.update', $votetype->id))) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('active', 'Active:') }}
            {{ Form::input('number', 'active') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('votetypes.show', 'Cancel', $votetype->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
