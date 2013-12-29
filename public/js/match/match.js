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
					submitMatchResult();
				});
				
			}
		});
	});


}

function submitMatchResult(){
		var valid = validateMatchResult();
}

function validateMatchResult(){
	var ret = false;
	// check winLose
	var radio = $("#checkWinLose .active > input").val();
	l(radio);
	if(radio != "" && radio != "undefined"){
		l("true");
		ret = true;
	}
	return ret;
}