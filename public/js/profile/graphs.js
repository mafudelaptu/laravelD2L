

/*
 * Copyright 2013 Artur Leinweber Date: 2013-01-01
 */
function drawPointHistoryChart() {

	matchModeID = $("#pointHistoryMMSelect option:selected").val();
	matchTypeID = $("#pointHistoryMTSelect option:selected").val();
	counts = $("#pointHistoryCountSelect option:selected").val();

	var user_id = getLastPartOfUrl();

	$.ajax({
		url : 'getPointsHistoryData',
		type : "GET",
		dataType : 'json',
		data : {
			matchmode_id : matchModeID,
			matchtype_id : matchTypeID,
			count : counts,
			user_id : user_id
		},
		success : function(result) {
			l(result);
			if (result.data != null) {
				chart = new Highcharts.Chart({
					chart : {
						renderTo : 'pointHistoryChart'
					},
					title : {
						text : ''
					},
					xAxis : {
						categories : result.xAxis,
						labels : {
							rotation : -45,
							align : 'right',
							enabled : true
						}
					},
					yAxis : {
						title : {
							text : 'Points'
						},
						plotBands : [ { // BRONZE
							from : 0,
							to : result.silverBorder,
							color : 'rgba(205, 133, 63, 0.1)',
							label : {
								text : 'Bronze Ranking',
								style : {
									color : '#606060'
								}
							}
						}, { // SILVER
							from : result.silverBorder,
							to : result.goldBorder,
							color : 'rgba(192, 192, 192, 0.1)',
							label : {
								text : 'Silver Ranking',
								style : {
									color : '#606060'
								}
							}

						}, { // GOLD
							from : result.goldBorder,
							to : result.diamondBorder,
							color : 'rgba(255, 215, 0, 0.1)',
							label : {
								text : 'Gold Ranking',
								style : {
									color : '#606060'
								}
							}

						}, { // DIAMOND
							from : result.diamondBorder,
							to : 99999,
							color : 'rgba(0, 136, 204, 0.1)',
							label : {
								text : 'Diamond Ranking',
								style : {
									color : '#606060'
								}
							}

						} ]
					},
					tooltip : {
						formatter : function() {
							id = this.series.data.indexOf(this.point);
							return generateInfoForPointshistory(result.pointsType[id], result.pointsChange[id], this.y, result.idText[id]);
						}
					},

					legend : {
						enabled : false
					},
					series : [ {
						type : "line",
						name : "Point-History for " + result.matchType + ": " + result.matchMode,
						data : result.data
					// data : [ 1850, 1620, 1500, 1333, 1100, 1060, 900, 1570 ]
					} ],
					credits : {
						enabled : false
					},
				});
			}
			else {
				html = '<div class="alert alert-warning"><p>You have to play at least one match in this Matchmode to view this Chart!</p>' + '<img src="http://'+window.location.host+'/img/profile/preview/previewPointHistory.png" width="100%">'
						+ '</div>';
				$("#pointHistoryChart").html(html);

			}

		}
	});
}
/*
 * Copyright 2013 Artur Leinweber Date: 2013-01-01
 */
function drawPointRoseChart() {

	var user_id = getLastPartOfUrl();
	$.ajax({
		url : 'getPointRoseData',
		type : "GET",
		dataType : 'json',
		data : {
			user_id : user_id
		},
		success : function(result) {
			l(result);
			l($(result.keys).size());
			if ($(result.keys).size() > 2) {
				series = [ {
					type : "area",
					name : 'Point-Area',
					data : result.data,
					pointPlacement : 'on'
				} ];

				maxValue = Array.max(result.data);

				l(maxValue);
				chart1 = new Highcharts.Chart({
					chart : {
						renderTo : 'pointRoseChart',
						polar : true,
						type : 'area'
					},

					title : {
						text : '',
					// x: -80
					},

					xAxis : {
						categories : result.keys,
						tickmarkPlacement : 'on',
						lineWidth : 0,
					},
					colors : [ '#AA4643', '#08C', 'gold', 'silver', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92' ],
					yAxis : {
						gridLineInterpolation : 'polygon',
						lineWidth : 0,
						min : (Array.min(result.data)),
						max : maxValue
					},

					tooltip : {
						shared : true,
						valuePrefix : ''
					},

					legend : {
						align : "center",
						verticalAlign : 'top',
						enabled : true,
					},

					series : series,

					credits : {
						enabled : false
					},
				});
			}
			else {
				html = '<div class="alert alert-warning"><p>You have to play at least one match in more than 2 Matchmodes to view this Chart!</p>' + '<img src="http://'+window.location.host+'/img/profile/preview/previewPointRose.png" width="100%">'
						+ '</div>';
				$("#pointRoseChart").html(html);
			}

		}
	});
}

/*
 * Copyright 2013 Artur Leinweber Date: 2013-01-01
 */
function generateInfoForPointshistory(pointsType, pointsChange, totalPoints, idText) {
	ret = "";
	if (parseInt(pointsChange) > 0) {
		pointsChange = "+" + pointsChange;
	}
	ret += "<b>" + idText + " - " + pointsType + ": " + pointsChange + "</b><br>";
	ret += "Points: " + totalPoints;
	return ret;
	// return '<b>' + this.series.name + '</b><br/>Match #'
	// + this.x + ': ' + this.y + " Points";

}