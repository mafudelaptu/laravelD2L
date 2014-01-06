@extends('layouts.scaffold')

@section('main')

<h1>Create News</h1>

{{ Form::open(array('route' => 'news.store')) }}
	<ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('content', 'Content:') }}
            {{ Form::textarea('content') }}
        </li>

        <li>
            {{ Form::label('order', 'Order:') }}
            {{ Form::input('number', 'order') }}
        </li>

        <li>
            {{ Form::label('active', 'Active:') }}
            {{ Form::input('number', 'active') }}
        </li>

        <li>
            {{ Form::label('show_date', 'Show_date:') }}
            {{ Form::text('show_date') }}
        </li>

        <li>
            {{ Form::label('end_date', 'End_date:') }}
            {{ Form::text('end_date') }}
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


