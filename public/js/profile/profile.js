$(function() {
  // Handler for .ready() called.
  if (document.URL.indexOf("/profile/") >= 0) {
  		//init Graphs
  		initProfileGraphs();
	}
});

function initProfileGraphs(){
	if ($("#generalWinRateTrendChart").length > 0) {
		//drawGeneralWinRateTrendChart();
	}

	// ELO-Rose
	if ($("#pointRoseChart").length > 0) {
		drawPointRoseChart();
	}

	// Elo-History
	if ($("#pointHistoryChart").length > 0) {
		drawPointHistoryChart();
	}
}