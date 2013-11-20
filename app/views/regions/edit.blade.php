@extends('layouts.scaffold')

@section('main')

<h1>Edit Region</h1>
{{ Form::model($region, array('method' => 'PATCH', 'route' => array('regions.update', $region->id))) }}
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
			{{ link_to_route('regions.show', 'Cancel', $region->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
