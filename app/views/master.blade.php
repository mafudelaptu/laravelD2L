<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		{{$title}}
	</title>
	<meta name="csrf-token" content="<?= csrf_token() ?>">
	{{ HTML::style("css/bootstrap.min.css")}}
	{{ HTML::style("css/bootstrap-theme.min.css")}}
	{{ HTML::style("css/font-awesome.min.css")}}
	{{ HTML::style("css/main.css")}}
	{{ HTML::style("css/findMatch/queueStats.css")}}

</head>
<body>
	<div class="main-container">
		@include("featured.index")
		@section("topnavi")
			@include("navigation.topnav")
		@show
		<div class="container">
			@yield("content")
		</div>
		@section("footer")
			@include("footer")
		@show
	</div>
	{{ HTML::script('js/jquery-1.10.2.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script("js/main.js")}}
	{{ HTML::script("js/findMatch/queue.js")}}
</body>
</html>