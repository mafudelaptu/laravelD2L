$(function(){
	if (document.URL.indexOf("/admin") >= 0) {
		initInsertInQueueButtons();
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
					type : matchtype_id
				},
				success : function(result) {
					l(result);
					$("#insertRandomUserinQueueResponse").html(result.status);
				}
		});
	});
}