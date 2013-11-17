@extends('layouts.scaffold')

@section('main')

<h1>Edit BanlistReason</h1>
{{ Form::model($banlistReason, array('method' => 'PATCH', 'route' => array('banlistReasons.update', $banlistReason->id))) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('banlistReasons.show', 'Cancel', $banlistReason->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
