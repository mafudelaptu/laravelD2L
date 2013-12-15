function updatePlayersFound(queue){
	if(typeof queue !== undefined && queue != null){
		$.each(queue, function(index, value){
			$("#labelPlayers"+index).html(value.count);

                        // Queue position updaten
                        $("#labelPosition"+index).html(value.position);
                    });
	}
}

function updateUserPool(skillBracket){
	var elem = $("#userPoolSpan");
	$(elem).html(skillBracket);
}

function updateNextMatchmakingTime(time){
        $("#nextMatchmaking").html(time);
}

function updateQueueStats(queueCounts){
	$("#prisonQueueCount").html(queueCounts[1]);
	$("#traineeQueueCount").html(queueCounts[2]);
	$("#amateurOrHigherQueueCount").html(queueCounts[3]);
	$("#forceQueueCount").html(queueCounts[-1]);
}

function initLeaveButton(){
	$("#leaveQueueButton").click(function(){
		leaveQueue();
	});
}