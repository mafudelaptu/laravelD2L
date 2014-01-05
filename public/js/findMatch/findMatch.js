$( document ).ready(function() {
	if (document.URL.indexOf("/find_match") >= 0) {
		// init Buttons
		initSelectMatchmodesOnclick();
	}
});

function initSelectMatchmodesOnclick(){
	var labels = $("#selectedMatchmodesCheckboxes label")
	labels.click(function(){
		label = $(this);

		var matchmode_id = label.find("input").val();
		var checked = label.find("input").attr('checked');

		if(checked){
			label.find("span").removeClass("badge-info");
			label.find("span").addClass("badge-default");
			$.removeCookie("selectedMatchmodes[" + matchmode_id + "]");
		}
		else{
			$.cookie("selectedMatchmodes[" + matchmode_id + "]", matchmode_id, {
				expires : 14
			});
			label.find("span").removeClass("badge-default");
			label.find("span").addClass("badge-info");
		}
		

		// visiualise onclick
		


		if(label.hasClass("badge-default")){
			
		}
		else{
			
		}
		
	});
}

function getSelectedMatchmodes(){
	var labels = $("#selectedMatchmodesCheckboxes label>input:checked");
	ret = new Array();
	$.each(labels, function(key, value){
		matchmode_id = $(value).val();
		ret.push(matchmode_id);
	});
	return ret;
}