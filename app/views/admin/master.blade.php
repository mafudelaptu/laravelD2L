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
	{{ HTML::style("css/findMatch/modal.css")}}
</head>
<body>
	<div id="wrap">
		<div class="main-container">
		@section("topnavi")
			@include("admin.navigation.topnavi")
		@show
		<div class="container">
			@yield("content")
		</div>
		
		</div>	
	</div>
	@section("footer")
			@include("footer")
		@show
	@include('generalModal')
	{{ HTML::script('js/10.jquery-1.10.2.min.js') }}
	{{ HTML::script('js/11.bootstrap.min.js') }}
	{{ HTML::script('js/14.bootbox.min.js') }}
	{{ HTML::script('js/20.jquery.cookie.js') }}
	{{ HTML::script('js/30.jquery.countDown.js') }}
	{{ HTML::script('js/31.jquery.stopwatch.js') }}
	{{ HTML::script('js/60.jquery.dataTables.min.js') }}
	{{ HTML::script('js/61.dataTable.paging.js') }}
	{{ HTML::script('js/80.highcharts.js') }}
	{{ HTML::script('js/90.buzz.js') }}
	{{ HTML::script("js/main.js")}}
	{{ HTML::script("js/findMatch/queue.js")}}
	{{ HTML::script("js/findMatch/queueModal.js")}}
	{{ HTML::script("js/admin/queue.js")}}
</body>
</html>