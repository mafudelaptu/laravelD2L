$( document ).ready(function() {

	// init Buttons
	initJoinQueueButtons();
});

function initJoinQueueButtons(){
	var justCM = $("#jCM").val();
	$("#quickJoin5vs5Single").click(function(){
		var joinMode = "single5vs5Queue";
		var quickJoin = true;
		$.ajax({
			url : "find_match/checkJoinQueue",
			type : "POST",
			dataType : 'json',
			data : {
				type : joinMode
			},
			success : function(result) {
				l(result);

				switch (result.status) {
					case true:
					joinSingleQueue(quickJoin, justCM, joinMode);
					break;

					case "inMatch":
					l("already in Match!");
					bootbox.alert("You are already in a Match! Please check your notifications! (top right)", function() {
					// beim Verlassen der Seite eine Warnung anzeigen:
					// deaktivieren
					setConfirmUnload(false);
					window.location = "openMatches.php";

				});
					break;
					case "queueLock":
					var time = checkResult.time;
					text = "<div align='center'><h4>You just declined a match or you were afk!</h4>" + "<p>You can't queue for <strong>" + time + "</strong>. Please be ready next time.</p></div>";

					bootbox.alert(text, function() {
						window.location = "find_match.php";
					});
					break;
					case "banned":
					var rejoin = getParameterByName("rejoin");
					if(rejoin != "true"){
						var banCounts = checkResult.banCounts;
						if (checkResult.banned) {
							var bannedTillTimestamp = checkResult.data.BannedTill;
							var bannedAtTimestamp = checkResult.data.BannedAt;
							var bannedAt = new Date(bannedAtTimestamp * 1000).format('d.m.Y - H:i:s');
							var bannedTill = new Date(bannedTillTimestamp * 1000).format('d.m.Y - H:i:s');
							l(bannedTill);

							var bannedBy = checkResult.bannData.Reason + " - <img src='" + checkResult.bannData.Avatar + "'><a href='profile.php?ID=" + checkResult.bannData.BannedBySteamID + "'>"
							+ checkResult.bannData.Name + "</a>";

							var banReasonText = checkResult.data.BanReasonText;
							var text = "<div align='center'><h4>You got warned " + bannedBy + "</h4> " + "<p>at " + bannedAt + " till " + bannedTill + "</p>" + "<p class='well'>" + banReasonText + "</p>"
							+ "<h3>It is your " + banCounts + ". warn!</h3>" + "<p>Until then you cant join normal Queue and stay in Prison-Queue! Try be more mannered next time.</p></div>";

							bootbox.alert(text, function(){
								joinSingleQueueFkt(quickJoin, groupID, justCM);
							});
						}
						else {
							if (banCounts == 1) {
								var text = "<div align='center'><h4>You got one active warn!</h4>"
								+ "<p>For the next warn you get a 24 hours Prison-Queue-Time. Please be more mannered in future.</p></div>";

								bootbox.alert(text, function() {
								//cleanBansOfPlayer();
								joinSingleQueueFkt(quickJoin, groupID, justCM);
							});
							}
							else {
								var text = "<div align='center'><h4>you are not banned anymore!</h4>" + "<p>Now you can join the Normal-Queue again!</p></div>";

								bootbox.alert(text, function() {
									joinSingleQueueFkt(quickJoin, groupID, justCM);
								});
							}
						}
					}

					break;
					case "inDuoQueue":
					text = "<div align='center'><h4>You are already in DuoQueue with Group:#" + checkResult.GroupID + "!</h4>" + "<p>Please use 'Duo-Queue-Join' to join the Queue!</p></div>";

					bootbox.alert(text, function() {
						window.location = "find_match.php?rejoin=true&joinType=duoQueueJoin&gid=" + checkResult.GroupID;
					});
					break;
					case "permaBanned":
					text = "<div align='center'><h4>You got permanently banned from system</h4><p>Check your warns in your profile to get more information.</p></div>";

					bootbox.alert(text, function() {
						window.location = "profile.php#warns";
					});
					break;
				}

			}
		});
});
}

function joinSingleQueue(quickJoin, justCM, joinMode){
	var modes = null;
	var region = null;

	modes = getMatchModes(joinMode, quickJoin);
	region = getRegion();
	if (modes.length > 0 && region.length > 0) {
		// beim Verlassen der Seite eine Warnung anzeigen:
		// aktivieren
		setConfirmUnload(true);
		$.ajax({
			url : "find_match/joinQueue",
			type : "POST",
			dataType : 'json',
			data : {
				modes : modes,
				region : regions
			},
			success : function(result) {
				l(result);
			});
	}
}

function getMatchModes(joinMode, quickJoin){
	var ret = new Array();
	if(quickJoin == true){
		switch(joinMode){
			case "single5vs5Queue":
				ret.push("9"); // CD
			break;
			default: ;
		}
		
	}
	else{

	}
	
	return ret;
}
