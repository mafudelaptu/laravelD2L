$(function() {
  // Handler for .ready() called.
  if (document.URL.indexOf("/match/") >= 0) {
  	var match_id = getLastPartOfUrl();
		// init Buttons
		initMatchButtons();
		initChat("MatchChat"+match_id);
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

	$("#matchCancelButton").click(function(){
		var match_id = getLastPartOfUrl();
		$.ajax(
			{			url : "getCancelModal",
			type : "GET",
			dataType : 'json',
			data : {
				match_id : match_id
			},
			success : function(html_data) {
				l(html_data);
				$("#generalModal div.modal-content").html(html_data.html);
				$("#generalModal").modal("show");

				$("#submitCancelButton").click(function(){
					submitCancelMatch(match_id);
				});
				
			}
		});
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

function showSuccessCancelVote(){
	bootbox.dialog({
		message: "You successfully voted for canceling the match! Do you want to stay on the matchpage?",
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
	// Typ des Submits
	
	var type = $(that).attr("data-type");

	switch(type){
		case "1": // upvote
		classType= "success";
		break;
		case "2": // downvote
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
			l(result);
			if(result.status == true){
						// switch Vote display
						html = "<span class='text-center text-"+classType+"'>voted!<span>";
						$(that).parent().html(html);

						// update html votecount on page
						decreaseVoteCount(type);

						// hide vote buttons if nesseccary
						hideVoteButtons(type);
					}
				}
			});
}

function submitCancelMatch(){
	var match_id = getLastPartOfUrl();

// reset Fehlerstatus
$("#leaverCancelMatchPannel input[type='checkbox']").css("color", "black");
$("#checkErrorDiv").html("");

	// reason auslesen
	reason = $("#checkGroup label.active > input").val();
	l(reason);


	// LeaverVotes auslesen
	checkedInputs = $("#leaverCancelMatchPannel input[type='checkbox']:checked");
	// array zum uebergeben zusammenbauen
	var leaverArray = new Array();
	$.each(checkedInputs, function(index,value){
		leaverArray.push($(value).val());
	});

	
	if(leaverArray.length == 0 && reason=="1"){
		$("#leaverCancelMatchPannel input[type='checkbox']").css("color", "red");
		error = '<br><div class="alert alert-block alert-danger"><p>select at least one Player who didn\'t join the Match!</p></div>';
		$("#checkErrorDiv").html(error);
	}
	else{
		$.ajax({
			url: 'cancelVote',
			type: "POST",
			dataType: 'json',
			data: {
				match_id:match_id, 
				leaverArray:leaverArray, 
				votetype:reason
			},
			success: function(result) {
				l(result);
				$("#generalModal").modal("hide");
				showSuccessCancelVote();
			}
		});
	}

}

function hideVoteButtons(type_id){
	l(type_id);
	var votes = getVoteCount(type_id);
	l(votes);
	if(votes <= 0){
		var buttons = $(".votebutton[data-type='"+type_id+"']");
	}

	l(buttons);
	if(buttons.length > 0){
		$.each(buttons, function(keys, values){
			$(values).hide();
		});		
	}
	
}

function decreaseVoteCount(type){
	// Typ des Submits
	value = getVoteCount(type);

	if(value > 0){
		value = value - 1;
		$(elem).html(value);
	}
}

function getVoteCount(type){
	switch(type){
		case "1":
		elem = "#userUpvotesLeft";

		break;
		case "2":
		elem = "#userDownvotesLeft";
		break;
	}
	value = parseInt($(elem).html());
	
	return value;
}