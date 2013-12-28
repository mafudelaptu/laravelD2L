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
			url : "match/getSubmitModal",
			type : "GET",
			dataType : 'json',
			data : {
				match_id : match_id
			},
			success : function(html_data) {
				l(html_data);
			}
		});
	});
}