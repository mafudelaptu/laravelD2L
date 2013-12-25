@extends('layouts.scaffold')

@section('main')

<h1>Create Uservotecount</h1>

{{ Form::open(array('route' => 'uservotecounts.store')) }}
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


