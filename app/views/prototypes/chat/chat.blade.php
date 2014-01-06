<div class="page-header">
	<h2><i class="fa fa-comment"></i>&nbsp;Chat</h2>
</div>

<div id="chat-wrap">
	<div id="chat-area-{{$chatname}}" style="overflow: auto; max-height: 200px;"></div>
</div>
<hr>
<div class="row" style="padding:10px 0; margin:0;">
	<div class="col-sm-1" align="center">
		<img src="{{Auth::user()->avatar}}" alt="Avatar" id="chat_user_avatar-{{$chatname}}">
		{{Form::hidden("chat_user_id-".$chatname, Auth::user()->id, array("id"=>"chat_user_id-".$chatname))}}
		{{Form::hidden("chat_user_name-".$chatname, Auth::user()->name, array("id"=>"chat_user_name-".$chatname))}}
	</div>
	<div class="col-sm-11">
		<textarea id="send-{{$chatname}}" maxlength='100'
		style="width: 100%;" placeholder='Message'></textarea>
		<div class="muted pull-right">
			<small>Hit "Enter" to submit your message!</small>
		</div>
	</div>
</div>