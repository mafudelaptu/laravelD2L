$( document ).ready(function() {

	// init Buttons
	initJoinQueueButtons();
});

function initJoinQueueButtons(){
		$("#quickJoin5vs5Single").click(function(){
			$.ajax({
				url : "find_match/joinQueue",
				type : "POST",
				dataType : 'json',
				data : {
					type : "single5vs5Queue"
				},
				success : function(result) {
					alert(result);
				}
			});
		});
	}