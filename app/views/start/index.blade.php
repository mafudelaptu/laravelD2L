@extends("master")
<style type="text/css">
	#wrapper{
		background: #fff !important;
	}
</style>
@section("topnavi")
	
@stop
@section("content")
	<h1 align="center">{{$title}}</h1>
	<p align="center">
		you need to login via Steam to access this page:
	</p>
	<p align="center">
		<a href="login">
		{{HTML::image("img/steam/steam_big.png")}}
		</a>
	</p>
	@if(Config::get('app.debug') == true)
	<p align="center">
		<a href="fakelogin">
			fake login
		</a>
	</p>
	@endif
	
@stop

@section("footer")
	
@stop