 
function initChat(chatname){
	var myDataRef = new Firebase('https://d2ldev.firebaseio.com/'+chatname);
	$('#send-'+chatname).keypress(function (e) {
		if (e.keyCode == 13) {

			var user_id = $("#chat_user_id-"+chatname).val();
			var name = $("#chat_user_name-"+chatname).val();
			var avatar = $("#chat_user_avatar-"+chatname).attr("src");
			var text = $('#send-'+chatname).val();
			var time = $.now();
			l(user_id+" "+avatar+" "+text);
			myDataRef.push({user_id: user_id, name:name, avatar:avatar, text: text, time:time });
			$('#send-'+chatname).val("");
		}
	});

	myDataRef.on('child_added', function(snapshot) {
		var message = snapshot.val();
		displayChatMessage(chatname, message.user_id, message.name, message.avatar, message.text, message.time);
	});
}

function displayChatMessage(chatname, user_id, name, avatar, text, time) {
	html = '<div class="row" style="border-bottom:1px solid #eee; padding:10px 0; margin:0;">';
	html += '<div class="col-sm-1" align="center">';
	html += '<a href="profile/'+user_id+'" target="_blank"><img src="'+avatar+'" alt="Avatar of '+name+'"></a>';
	html += '</div>';
	html += '<div class="col-sm-11">';
	html += '<div>';
	html += '<a href="profile/'+user_id+'" target="_blank">';
	html += '<small><strong>'+name+'</strong></small>';
	html += '</a>';
	html += '<span class="muted pull-right">';
	html += '<small style="font-size:9px">'+$.timeago(time)+'</small>';
	html += '</span>';
	html += '</div>';
	html += '<div style="">'+text+'</div>';
	html += '</div>';
	html += '</div>';
	$('#chat-area-'+chatname).append(html);
 		//scroll
 		$('#chat-area-'+chatname)[0].scrollTop = $('#chat-area-'+chatname)[0].scrollHeight;
 	};