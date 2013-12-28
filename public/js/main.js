var debug = true;

$( document ).ready(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
  });

  initRegionMenu();
  initTooltips();
});

function l(stuff){
  if(debug){
    console.log(stuff);
  }
  
}

function setConfirmUnload(on) {

  window.onbeforeunload = (on) ? unloadMessage : null;

  function unloadMessage() {

    return "Please do NOT close this Tab/the Browser or refresh this site! Always push 'Leave Queue' before you want to leave dota2-league.net, else you stay in Queue! This cause a bad experience on dota2-league.net. Thanks!";
  }

}

function setRegion(id){
  $.ajax({
      url : "setRegion",
      type : "POST",
      dataType : 'json',
      data : {
        region : id,
      },
      success : function(data){
        window.location.reload();
      }
    });
}

function initRegionMenu(){
  $("#regionMenu li>a").click(function(){
      region_id = $(this).attr("data-id");
      setRegion(region_id);
  });
}

function initTooltips(){
  $(".t").tooltip();
}

function getLastPartOfUrl(){
  var url = $(location).attr('pathname');
    parts = url.split('/');
    lastPart = parts[parts.length-1 ];
  return lastPart;
}