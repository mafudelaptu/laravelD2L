$(function() {
  // Handler for .ready() called.
  if (document.URL.indexOf("/match/") >= 0) {
		// init Buttons
		initMatchButtons();
	}
});

function initMatchButtons(){
	// Submit Button
	$("#matchSubmitButton").click(function(){
		var match_id = getLastPartOfUrl();
		$.ajax({
			url : "getSubmitModal",
			type : "GET",
			dataType : 'json',
			data : {
				match_id : match_id
			},
			success : function(html_data) {
				l(html_data);
				$("#generalModal div.modal-content").html(html_data.html);
				$("#generalModal").modal("show");

				$("#submitMatchResultButton").click(function(){
					submitMatchResult(match_id);
				});
				
			}
		});
	});

	$(".votebutton").click(function(){
		matchVotePlayer(this);
	});

}

function submitMatchResult(match_id){
	var radio = $("#checkWinLose .active > input").val();
	var valid = validateMatchResult(radio);
	if(valid){
		matchResultValidError("hide");
		$.ajax({
			url : "submitResult",
			type : "POST",
			dataType : 'json',
			data : {
				match_id : match_id,
				result: radio
			},
			success : function(response) {
				l(response);
				$("#generalModal").modal("hide");
				showSuccessMatchResultSubmission();
			}
		});
	}
	else{
		matchResultValidError("show");
	}
}

function validateMatchResult(radio){
	var ret = false;
	// check winLose
	l(radio);
	if(radio != "" && typeof radio != "undefined"){
		l("true");
		ret = true;
	}
	return ret;
}

function matchResultValidError(type){
	l(type);
	switch(type){
		case "show":
		$("#checkWinLoseErrorDiv").removeClass("hide");
		break;
		case "hide":
		$("#checkWinLoseErrorDiv").addClass("hide");
		
		break;
	}
}

function showSuccessMatchResultSubmission(){
	bootbox.dialog({
		message: "You successfully submitted the matchresult! Do you want to stay on the matchpage?",
		title: "Match result",
		buttons: {
			success: {
				label: "Stay on matchpage!",
				className: "btn-default",
				callback: function() {
					window.location.reload();
				}
			},
			danger: {
				label: "Go to 'find match'",
				className: "btn-default",
				callback: function() {
					window.location.href = "http://"+window.location.hostname+"/find_match";
				}
			},
			main: {
				label: "go to your profile",
				className: "btn-default",
				callback: function() {
					window.location.href = "http://"+window.location.hostname+"/profile";
				}
			}
		}
	});
}

function sendPingNotification(that){
	var user_id = $(that).attr("data-value");
	var match_id = getParameterByName("matchID");
	
	l("SID:"+user_id+" MID:"+matchID);
	
	l("Start sendPingNotification");
	$.ajax({
		url : 'sendPing',
		type : "POST",
		dataType : 'json',
		data : {
			user_id : user_id,
			match_id : match_id
		},
		success : function(result) {
			l("sendPingNotification success");
			l(result);
		}
	});
	l("End sendPingNotification");
	
}

function matchVotePlayer(that){
	var user_id = $(that).val();
	var match_id = getLastPartOfUrl();
	var type = $(that).attr("data-label");

	switch(type){
		case "Upvote":
			classType= "success";
			break;
		case "Downvote":
			classType = "danger";
			break;
		default:
			return false;
			break;
	}
	$.ajax({
		url : 'votePlayer',
		type : "POST",
				dataType : 'json',
				data : {
					user_id : user_id,
					match_id : match_id,
					type: type
				},
				success : function(result) {
					if(result.status == true){
						// switch Vote display
						html = "<span class='text-center text-"+classType+"'>voted!<span>";
						$(that).parent().html(html);
					}
		}
	});



}