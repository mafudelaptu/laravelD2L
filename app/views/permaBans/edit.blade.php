@extends('layouts.scaffold')

@section('main')

<h1>Edit PermaBan</h1>
{{ Form::model($permaBan, array('method' => 'PATCH', 'route' => array('permaBans.update', $permaBan->id))) }}
	<ul>
        <li>
            {{ Form::label('user_id', 'User_id:') }}
            {{ Form::text('user_id') }}
        </li>

        <li>
            {{ Form::label('banlistreason_id', 'Banlistreason_id:') }}
            {{ Form::input('number', 'banlistreason_id') }}
        </li>

        <li>
            {{ Form::label('banned_at', 'Banned_at:') }}
            {{ Form::text('banned_at') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('permaBans.show', 'Cancel', $permaBan->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
