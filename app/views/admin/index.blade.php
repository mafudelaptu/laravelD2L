@section('content')
	<h1>{{$heading}}</h1>
	@include("admin.queue.insertInQueue")
	@include("admin.queue.fakeSubmits")
@stop