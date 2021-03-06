var timePulling = 3000;
var waitingTime4AcceptReady = 15000;
var waitingTime4AllReady = 20000;

$( document ).ready(function() {
	if (document.URL.indexOf("/find_match") >= 0) {
		// init Buttons
		initJoinQueueButtons();
	}
});
function getJustCM(){
	return $("#jCM").val();
}
function initJoinQueueButtons(){
	var justCM = getJustCM();
	$("#quickJoin5vs5Single").click(function(){	
		var matchtype_id = 1;
		var quickJoin = true;
		joinQueueFkt(justCM, matchtype_id, quickJoin);
	});

	$("#join5vs5SingleButton").click(function(){	
		var matchtype_id = 1;
		var quickJoin = false;
		joinQueueFkt(justCM, matchtype_id, quickJoin);
	});

	$("#join1vs1Button").click(function(){	
		var matchtype_id = 2;
		var quickJoin = false;
		joinQueueFkt(justCM, matchtype_id, quickJoin);
	});
}

function joinQueueFkt(justCM, matchtype_id, quickJoin){

	$.ajax({
		url : "find_match/checkJoinQueue",
		type : "POST",
		dataType : 'json',
		data : {
			type : matchtype_id
		},
		success : function(result) {
			l(result);

			switch (result.status) {
				case true:
				joinQueue(quickJoin, justCM, matchtype_id);
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
				var time = result.time;
				text = "<div align='center'><h4>You just declined a match or you were afk!</h4>" + "<p>You can't queue for <strong>" + time + "</strong>. Please be ready next time.</p></div>";

				bootbox.alert(text, function() {

				});
				break;
				case "banned":
				var rejoin = getParameterByName("rejoin");
				if(rejoin != "true"){
					var banCounts = result.banCounts;
					if (result.banned) {
						var bannedTillTimestamp = result.data.BannedTill;
						var bannedAtTimestamp = result.data.BannedAt;
						var bannedAt = new Date(bannedAtTimestamp * 1000).format('d.m.Y - H:i:s');
						var bannedTill = new Date(bannedTillTimestamp * 1000).format('d.m.Y - H:i:s');
						l(bannedTill);

						var bannedBy = result.bannData.Reason + " - <img src='" + checkResult.bannData.Avatar + "'><a href='profile.php?ID=" + checkResult.bannData.BannedBySteamID + "'>"
						+ result.bannData.Name + "</a>";

						var banReasonText = result.data.BanReasonText;
						var text = "<div align='center'><h4>You got warned " + bannedBy + "</h4> " + "<p>at " + bannedAt + " till " + bannedTill + "</p>" + "<p class='well'>" + banReasonText + "</p>"
						+ "<h3>It is your " + banCounts + ". warn!</h3>" + "<p>Until then you cant join normal Queue and stay in Prison-Queue! Try be more mannered next time.</p></div>";

						bootbox.alert(text, function(){
							joinQueue(quickJoin, justCM, matchtype_id);
						});
					}
					else {
						if (banCounts == 1) {
							var text = "<div align='center'><h4>You got one active warn!</h4>"
							+ "<p>For the next warn you get a 24 hours Prison-Queue-Time. Please be more mannered in future.</p></div>";

							bootbox.alert(text, function() {
									//cleanBansOfPlayer();
									joinQueue(quickJoin, justCM, matchtype_id);
								});
						}
						else {
							var text = "<div align='center'><h4>you are not banned anymore!</h4>" + "<p>Now you can join the Normal-Queue again!</p></div>";

							bootbox.alert(text, function() {
								joinQueue(quickJoin, justCM, matchtype_id);
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
}

function joinQueue(quickJoin, justCM, matchtype_id){
	var modes = null;

	retModes = getMatchModes(matchtype_id, quickJoin);
	retModes.success(function(modes){
		l(modes);
		if (modes.length > 0) {
				// beim Verlassen der Seite eine Warnung anzeigen:
				// aktivieren
				setConfirmUnload(true);
				$.ajax({
					url : "find_match/joinQueue",
					type : "POST",
					dataType : 'json',
					data : {
						modes : modes,
						matchtype_id : matchtype_id
					},
					success : function(result) {
						l(result);
						$.ajax({
							url : "find_match/getMMInfo",
							type : "GET",
							dataType : 'json',
							data : {
								modes : modes
							},
							success : function(html_data) {
								l(html_data);

								

								$("#generalModal .modal-content").html(html_data.html);
								$("#generalModal .modal-dialog").css({
									width : '81%',
									'left' : function() {
										return -($(this).width() / 2);
									}
								});
								$("#generalModal").modal({
									backdrop : "static",
									keyboard : false
								});

								// Uhr starten
								$('#matchMakingClock').stopwatch().stopwatch('start');

								// Chat init
								initChat("MatchmakingChat");

								// init leave Button
								initLeaveButton();

								doMatchmaking(modes, matchtype_id, quickJoin);
							}
						});
					}
				});
}	
else{
	// error
	$("#selectMatchmodesPanel").removeClass("panel-default").addClass("panel-danger");
}
});
}


var doMatchmakingTimeout = null;
function doMatchmaking(modes, matchtype_id, quickJoin){
			// auslesen ob forceSearch checkbox activiert wurde
			var forceChecked = $("#forceSearching").attr("checked");
			if (forceChecked == "checked") {
				force = true;
			}
			else {
				force = false;
			}

			$.ajax({
				url : 'find_match/doMatchmaking',
				type : "GET",
				dataType : 'json',
				data : {
					modes : modes,
					matchtype_id: matchtype_id,
					forceSearch : force
				},
				success : function(result) {
					l(result);

					updatePlayersFound(result.queue);
					updateUserPool(result.skillBracket);
					updateNextMatchmakingTime(result.nextMatchmaking);
					updateQueueStats(result.queueCounts);

					if (result.status == "searching") {
						// check still in DuoQueue?
						doMatchmakingTimeout = setTimeout(function() {
							doMatchmaking(modes, matchtype_id, quickJoin);
						}, timePulling);
						
					}
					else if (result.status == "finished") {

						clearTimeout(doMatchmakingTimeout);
						doMatchmakingTimeout = null;

							// match found Sound abspielen
							playMatchFoundSound();
							
							// title blinken lassen wenn match geufnden
							$.titleAlert("Match found!", {
								stopOnFocus : true,
								duration : 0,
								interval : 500
							});

							$('.modal').modal('hide');

							setTimeout(function() {
									// aktuelles Modal schlie�en und
									// ReadyMatchModal
									// �ffnen
									
									matchWasFound(result.match_id, quickJoin, matchtype_id);
								}, 500);
						}
						else if (result.status == "notInQueue") {
							setConfirmUnload(false);
							clearTimeout(doMatchmakingTimeout);
							doMatchmakingTimeout = null;

							// JoinQueue Modal schlie�en
							$("#generalModal").modal("hide");
							text = "<div align='center'><h4>You are not in Queue anymore</h4>" +
							"<p>You had an error in queueing! Please rejoin the Queue.</p>" +
							"</div>";

							bootbox.alert(text, function() {
								window.location = "find_match";
							});
						}
						else{
							setConfirmUnload(false);
							clearTimeout(doMatchmakingTimeout);
							doMatchmakingTimeout = null;

							// JoinQueue Modal schlie�en
							$("#generalModal").modal("hide");
							text = "<div align='center'><h4>You are not in Queue anymore</h4>" +
							"<p>You had an error in queueing! Please rejoin the Queue.</p>" +
							"</div>";

							bootbox.alert(text, function() {
								window.location = "find_match";
							});
						}
					}
				});
}

/*
 * Copyright 2013 Artur Leinweber Date: 2013-01-01
 */
 var timeout = null;
 function matchWasFound(match_id, quickJoin, matchtype_id) {
		// Uhr resetten
		$('#matchMakingClock').stopwatch('reset');
		$('#matchMakingClock').stopwatch('stop');
		$('#matchMakingClock').html("");

		$.ajax({
			url : "find_match/getReadyMatch",
			type : "GET",
			dataType : 'json',
			success : function(html_data) {
				l(html_data);
				$("#generalModal .modal-content").html(html_data.html);						

				$("#generalModal span.countdown").stop(true);
				$("#generalModal span.countdown").html("");

				clearTimeout(timeout);
				timeout = null;

				// initialisier Countdown
				waitingDauer = waitingTime4AcceptReady / 1000;

				$("#generalModal span.countdown").countDown({
					startNumber : waitingDauer,
					startFontSize : "20px",
					endFontSize : "20px",
				});

				// Modal anzeigen
				$('#generalModal').modal({
					backdrop : "static",
					keyboard : false
				});

				// Nach 15 Sekunden Player aus der Queue hauen
				timeout = setTimeout(function() {
					clearTimeout(timeout);
					timeout = null;
					kickFromQueue(match_id, "autoKick", quickJoin, true, matchtype_id);
				}, waitingTime4AcceptReady);

				// Wenn Accept dann nächsten Modal aufmachen
				$("#readyMatchAcceptButton").click(function() {
					l("matchWasFoundModal Accept clicked");
					$("#generalModal span.countdown").html("");
					clearTimeout(timeout);
					timeout = null;
					acceptMatch(match_id, quickJoin, matchtype_id);
				});

				// Wenn Cancel dann Player aus der Queue hauen
				$("#readyMatchCancelButton").click(function() {
					clearTimeout(timeout);
					timeout = null;
					$("#generalModal span.countdown").html("");
					kickFromQueue(match_id, "decline", quickJoin, true, matchtype_id);
				});
			}
		});
}

/*
 * Copyright 2013 Artur Leinweber Date: 2013-01-01
 */
 function kickFromQueue(match_id, reason, quickJoin, cancelRejoin, matchtype_id) {
 	l("kickFromQueue Start");
 	$('.modal').modal('hide');
 	$("#generalModal span.countdown").html("");

 	var redirect = true;

 	l(reason);
 	switch (reason) {
 		case "decline":
 		case "autoKick":
 		$.ajax({
 			url : 'find_match/setQueueLock',
 			type : "POST",
 			dataType : 'json',
 			success : function(result) {
 				l("insertLock success");
 				if (result.status == true) {
 					l("added insertLock!");
 				}
 			}
 		});
 		break;
 	}

 	$.ajax({
 		url : 'find_match/cleanUpFailedQueue',
 		type : "POST",
 		dataType : 'json',
 		data : {
 			match_id : match_id,
 			reason : reason
 		},
 		success : function(data) {
 			l("test redirect");
 			l(data);
 		}
 	});
        // SeitenWarnung daktivieren
        setConfirmUnload(false);

        if (cancelRejoin == false) {
                //l("ey homo!");
                var justCM = getJustCM();
                joinQueue(quickJoin, justCM, matchtype_id);
            }
        }

        function getMatchModes(matchtype_id, quickJoin){
        	var ret = null;
        	if(quickJoin == true){
        		ret = $.ajax({
        			url : "matchmodes/getQuickJoinModes",
        			type : "GET",
        			dataType : 'json',
        		});
        	}
        	else{
        		selected = getSelectedMatchmodes(matchtype_id);
        		ret = $.ajax({
        			url : "matchmodes/getMatchmodeData",
        			type : "GET",
        			dataType : 'json',
        			data : {
        				matchtype_id : matchtype_id,
        				selectedArray: selected
        			}
        		});	
        	}
        	return ret;
        }

        function leaveQueue(){
	// Uhr resetten
	$('#matchMakingClock').stopwatch('reset');
	$('#matchMakingClock').stopwatch('stop');
	$('#matchMakingClock').html("");

	// timeout Beenden
	clearTimeout(doMatchmakingTimeout);
	doMatchmakingTimeout = null;

	$.ajax({
		url : 'find_match/leaveQueue',
		type : "POST",
		dataType : 'json',
		success : function(result) {
			l("leaveQueue2 success");
			// SeitenWarnung daktivieren
			setConfirmUnload(false);

			$(".modal").modal("hide");
		}
	});
}

function acceptMatch(match_id, quickJoin, matchtype_id){
	$('#generalModal').modal('hide');

		$.ajax({
			url : 'find_match/acceptMatch',
			type : "POST",
			dataType : 'json',
			success : function(result) {

				if (result.status == true) {
					$.ajax({
						url : 'find_match/getWaitingForOtherUsers',
						type : "GET",
						dataType : 'json',
						data : {
							matchtype_id : matchtype_id
						},
						success : function(html_data) {
							l("set HTML");
							$('#generalModal .modal-content').html(html_data.html);
							l("setted HTML");

							$("#spanWaitingMatchID").html(match_id);
								l("show Modal");
								// show Waiting for all Ready Modal
								$('#generalModal').modal({
									backdrop : "static",
									keyboard : false
								});
								l("showed Modal");
								// Countdown anwerfen
								$("#generalModal span.countdown").stop(true);
								$("#generalModal span.countdown").html("");
								waitingDauer = waitingTime4AllReady / 1000;
								$("#generalModal span.countdown").countDown({
									startNumber : waitingDauer,
									startFontSize : "20px",
									endFontSize : "20px",
								});
								
								checkAllReadyForMatch(match_id, 0, quickJoin, matchtype_id);
							}
						});
					

				}
				else {
					l("accept Match failed");

				}
				l("acceptMatch2 End");
			}
		});

}

var iterationTime = 2000;
var runnedTimeout = null;
function checkAllReadyForMatch(match_id, runnedTime, quickJoin, matchtype_id) {
	l("Start checkAllReadyForMatch2");
	// wenn noch gewartet werden kann, dann nochmal suchen
	if (runnedTime <= waitingTime4AllReady) {

		$.ajax({
			url : 'find_match/checkAllReadyForMatch',
			type : "GET",
			dataType : 'json',
			data : {
				match_id : match_id
			},
			success : function(result) {
				l("getCountsOfReadyPlayer success");
				if (result.status == true) {

					badges = $("#generalModal span[class*='label']");

					countReady = result.countReady;

					l("count:" + countReady);

					runnedTimeout = null;
					
					switch(matchtype_id){
						// wenn 1vs1 Queueu -> dann count 2 ausreichend
						case 2:
							// haben alle auf Ready geklickt?
							if (countReady == 2) {
								l("2 gefunden!");
								$('.modal').modal('hide');

								// timeout clearen
								clearTimeout(runnedTimeout);
								runnedTimeout = null;

								// SeitenWarnung daktivieren
								setConfirmUnload(false);

								// Umleitung auf Match-Seite
								setTimeout(function() {
									window.location = "match/" + match_id;
									// l("UMLEITUNG");
								}, 1000);
							}

							// irgendjemand bereits abgebrochen
							else if (countReady == null || countReady == 0) {
								// timeout clearen
								clearTimeout(runnedTimeout);
								runnedTimeout = null;
								kickFromQueue(match_id, "autoKickAfterAccept", quickJoin, false, matchtype_id);
							}
							// noch nciht alle auf Ready geklickt
							else {
								var i = 0;
								$(badges).each(function() {
									if (i < countReady) {
										$(this).attr("class", "label label-success");
									}
									i++;
								});
								// Rekursion und runnedTime erhï¿½hen
								runnedTime += iterationTime;
								runnedTimeout = setTimeout(function() {
									checkAllReadyForMatch(match_id, runnedTime, quickJoin, matchtype_id);
								}, iterationTime);

							}
							break;
						// alle anderen matchTypes 5vs5 und so
						default:
							// haben alle auf Ready geklickt?
							if (countReady == 10) {
								$('.modal').modal('hide');

								// timeout clearen
								clearTimeout(runnedTimeout);
								runnedTimeout = null;

								// SeitenWarnung daktivieren
								setConfirmUnload(false);

								// Umleitung auf Match-Seite
								setTimeout(function() {
									window.location = "match/" + match_id;
									// l("UMLEITUNG");
								}, 1000);
							}

							// irgendjemand bereits abgebrochen
							else if (countReady == null || countReady == 0) {
								// timeout clearen
								clearTimeout(runnedTimeout);
								runnedTimeout = null;
								kickFromQueue(match_id, "autoKickAfterAccept", quickJoin, false, matchtype_id);
							}
							// noch nciht alle auf Ready geklickt
							else {

								// Badges einfï¿½rben, je nachdem wie viele
								// Player
								// akzeptiert haben
								var i = 0;
								$(badges).each(function() {
									if (i < countReady) {
										$(this).attr("class", "label label-success");
									}
									i++;
								});

								// Rekursion und runnedTime erhï¿½hen
								runnedTime += iterationTime;

								runnedTimeout = setTimeout(function() {
									l("singleQueue5vs5 rekursion");
									checkAllReadyForMatch(match_id, runnedTime, quickJoin, matchtype_id);
								}, iterationTime);

							}
						}		
					}
				}
			});

}
	// zu lange gewartet, Match abbrechen, Player aus QUeue hauen und
	// MatchTeam/Match lï¿½schen
	else {
		kickFromQueue(match_id, "autoKickAfterAccept", quickJoin, false, matchtype_id);
	}
	l("End checkAllReadyForMatch2");
}