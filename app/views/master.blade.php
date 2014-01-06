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
	{{ HTML::style("css/bootstrap_datatable.css")}}
	{{ HTML::style("css/findMatch/findMatch.css")}}
	{{ HTML::style("css/findMatch/queueStats.css")}}
	{{ HTML::style("css/findMatch/modal.css")}}
	{{ HTML::style("css/match/match.css")}}
	{{ HTML::style("css/profile/profile.css")}}
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
	@include('generalModal')


	{{ HTML::script('js/10.jquery-1.10.2.min.js') }}
	{{-- HTML::script('js/jquery-1.10.2.min.map') --}}
	{{ HTML::script('js/11.bootstrap.min.js') }}
	{{ HTML::script('js/14.bootbox.min.js') }}
	{{ HTML::script('js/20.jquery.cookie.js') }}
	{{ HTML::script('js/20.jquery.validate.min.js') }}
	{{ HTML::script('js/30.jquery.countDown.js') }}
	{{ HTML::script('js/31.jquery.stopwatch.js') }}
	{{ HTML::script('js/32.jquery.timeago.js') }}
	{{ HTML::script('js/33.jquery.titleAlert.min.js') }}
	{{ HTML::script('js/60.jquery.dataTables.min.js') }}
	{{ HTML::script('js/61.dataTable.paging.js') }}
	{{ HTML::script('js/80.highcharts.js') }}
	{{ HTML::script('js/90.buzz.js') }}
	<script src='https://cdn.firebase.com/v0/firebase.js'></script>
	{{ HTML::script("js/main.js")}}
	{{ HTML::script("js/bootstrap_datatable.js")}}
	{{ HTML::script("js/findMatch/findMatch.js")}}
	{{ HTML::script("js/findMatch/queue.js")}}
	{{ HTML::script("js/findMatch/queueModal.js")}}
	{{ HTML::script("js/audio/audio.js")}}
	{{ HTML::script("js/match/match.js")}}
	{{ HTML::script("js/profile/profile.js")}}
	{{ HTML::script("js/profile/graphs.js")}}
	{{ HTML::script("js/ladder/ladder.js")}}
	{{ HTML::script("js/home/home.js")}}
	{{ HTML::script("js/firebase/chat.js")}}
	

</body>
</html>