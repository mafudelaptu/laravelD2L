@extends('layouts.scaffold')

@section('main')

<h1>Edit Globalsetting</h1>
{{ Form::model($globalsetting, array('method' => 'PATCH', 'route' => array('globalsettings.update', $globalsetting->id))) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('value', 'Value:') }}
            {{ Form::text('value') }}
        </li>

        <li>
            {{ Form::label('active', 'Active:') }}
            {{ Form::input('number', 'active') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('globalsettings.show', 'Cancel', $globalsetting->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
