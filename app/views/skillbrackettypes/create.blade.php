@extends('layouts.scaffold')

@section('main')

<h1>Create Skillbrackettype</h1>

{{ Form::open(array('route' => 'skillbrackettypes.store')) }}
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


