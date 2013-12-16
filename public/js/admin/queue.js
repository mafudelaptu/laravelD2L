$(function(){
	if (document.URL.indexOf("/admin") >= 0) {
		initInsertInQueueButtons();
		initSetAllReadyButton();
	}
});

function initInsertInQueueButtons(){
	var buttons = $("#insertUserIntoQueueForm button");
	
	buttons.click(function(){
		var matchtype_id = $(this).attr("data-id");
		$.ajax({
				url : "admin/queue/insertInQueue",
				type : "POST",
				dataType : 'json',
				data : {
					matchtype_id : matchtype_id
				},
				success : function(result) {
					l(result);
					$("#insertRandomUserinQueueResponse").html(result.status);
				}
		});
	});
}

function initSetAllReadyButton(){
	$("#setAllReadyButton").click(function(){
		var match_id = $("#submitAllMatchAcceptMatchID").val();
		$.ajax({
				url : "admin/queue/setAllReady",
				type : "POST",
				dataType : 'json',
				data : {
					match_id : match_id
				},
				success : function(result) {
					l(result);
					$("#submitAllMatchAcceptResponse").html(result.status);
				}
		});
	});
}