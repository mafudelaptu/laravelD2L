@extends('layouts.scaffold')

@section('main')

<h1>All BanlistReasons</h1>

<p>{{ link_to_route('banlistReasons.create', 'Add new banlistReason') }}</p>

@if ($banlistReasons->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($banlistReasons as $banlistReason)
				<tr>
					<td>{{{ $banlistReason->name }}}</td>
                    <td>{{ link_to_route('banlistReasons.edit', 'Edit', array($banlistReason->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('banlistReasons.destroy', $banlistReason->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no banlistReasons
@endif

@stop
