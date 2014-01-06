@extends('layouts.scaffold')

@section('main')

<h1>Edit News</h1>
{{ Form::model($news, array('method' => 'PATCH', 'route' => array('news.update', $news->id))) }}
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
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('news.show', 'Cancel', $news->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
