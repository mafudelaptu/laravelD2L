<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
        {{ HTML::style("css/bootstrap.min.css")}}
		{{ HTML::style("css/bootstrap-theme.min.css")}}
		{{ HTML::style("css/main.css")}}
		<script src='https://cdn.firebase.com/v0/firebase.js'></script>
        <title>Laravel 4 Chat</title>
    </head>
    <body>	
    	<div class="container">
    		<div id='messagesDiv'></div>
        <input type='text' id='nameInput' placeholder='Name'>
    	<input type='text' id='messageInput' placeholder='Message'>
    	<hr>
    	<div id='messagesDiv2'></div>
        <input type='text' id='nameInput2' placeholder='Name'>
    	<input type='text' id='messageInput2' placeholder='Message'>
    	</div>
    	
        {{ HTML::script('js/jquery-1.10.2.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{-- HTML::script("js/firebase.js")}}
        {{ HTML::script("js/main.js")}}
    </body>
</html>