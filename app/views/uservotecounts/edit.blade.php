@extends('layouts.scaffold')

@section('main')

<h1>Edit Uservotecount</h1>
{{ Form::model($uservotecount, array('method' => 'PATCH', 'route' => array('uservotecounts.update', $uservotecount->id))) }}
	<ul>
        <li>
            {{ Form::label('user_id', 'User_id:') }}
            {{ Form::text('user_id') }}
        </li>

        <li>
            {{ Form::label('upvotes', 'Upvotes:') }}
            {{ Form::input('number', 'upvotes') }}
        </li>

        <li>
            {{ Form::label('downvotes', 'Downvotes:') }}
            {{ Form::input('number', 'downvotes') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('uservotecounts.show', 'Cancel', $uservotecount->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
