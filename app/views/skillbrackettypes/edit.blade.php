@extends('layouts.scaffold')

@section('main')

<h1>Edit Skillbrackettype</h1>
{{ Form::model($skillbrackettype, array('method' => 'PATCH', 'route' => array('skillbrackettypes.update', $skillbrackettype->id))) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('winpoints', 'Winpoints:') }}
            {{ Form::input('number', 'winpoints') }}
        </li>

        <li>
            {{ Form::label('losepoints', 'Losepoints:') }}
            {{ Form::input('number', 'losepoints') }}
        </li>

        <li>
            {{ Form::label('active', 'Active:') }}
            {{ Form::input('number', 'active') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('skillbrackettypes.show', 'Cancel', $skillbrackettype->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
