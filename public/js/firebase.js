var myDataRef = new Firebase('https://d2ldev.firebaseio.com/');
$('#messageInput').keypress(function (e) {
	if (e.keyCode == 13) {
		var name = $('#nameInput').val();
		var text = $('#messageInput').val();
		myDataRef.push({name: name, text: text});
		$('#messageInput').val('');
	}
});
myDataRef.on('child_added', function(snapshot) {
	var message = snapshot.val();
	displayChatMessage(message.name, message.text);
});
function displayChatMessage(name, text) {
	$('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv'));
	$('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
}


var myDataRef2 = new Firebase('https://d2ldev2.firebaseio.com/chat/');
$('#messageInput2').keypress(function (e) {
	if (e.keyCode == 13) {
		var name = $('#nameInput2').val();
		var text = $('#messageInput2').val();
		myDataRef2.push({name: name, text: text});
		$('#messageInput2').val('');
	}
});
myDataRef2.on('child_added', function(snapshot) {
	var message = snapshot.val();
	displayChatMessage2(message.name, message.text);
});
function displayChatMessage2(name, text) {
	$('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv2'));
	$('#messagesDiv2')[0].scrollTop = $('#messagesDiv2')[0].scrollHeight;
}