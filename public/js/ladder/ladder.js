$(function() {
  // Handler for .ready() called.
  if (document.URL.indexOf("/ladder/") >= 0) {
		// init Buttons
		initLadderTable();
	}
});

function initLadderTable(){

	var matchtype_id = getParameterByName("ladder");
	var user_id = getLastPartOfUrl();
	if(matchtype_id == ""){
		matchtype_id = $("#ladderNavi > li.active").attr("data-mtid");
	}
	l(matchtype_id+" "+user_id);
		$("#ladderTable").dataTable({
 		   "sPaginationType": "bootstrap",
 	         "aaSorting": [[ 2, "desc" ]],
// 	         "aoColumnDefs": [
// 	                          { 'bSortable': false, 'aTargets': [ 1 ] }
// 	                       ],
 	         "bSort": false,
 	         "bDestroy": true,
 	         
 	        "oLanguage": {
 	            "sLengthMenu": "_MENU_ Players per page",
 	            "sInfo": "Showing _START_ to _END_ of _TOTAL_ Players"
 	        },
 	      //  "iDisplayStart": 30,
 		 "bProcessing": true,
 	        "bServerSide": true,
 	        "sAjaxSource": "getLadderData",
 	        'fnServerParams': function ( aoData ) {
     		    aoData.push(
     		    		{ "name": "user_id", "value": user_id},
     		    		{ "name": "matchmode_id", "value": ""},
     		    		{ "name": "matchtype_id", "value": matchtype_id}
     		    )
     		}
     });
}
