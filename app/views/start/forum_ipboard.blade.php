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
		You have to be logged-in in our forum to access this page. 
	</p>
	<p align="center">
		<a href="{{GlobalSetting::getForumLink()}}">go to forum</a>
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