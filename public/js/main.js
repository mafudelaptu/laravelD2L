var debug = true;

$( document ).ready(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
  });

  initRegionMenu();
  initTooltips();
  initPopovers();
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

function initPopovers(){
  $("*[data-toggle=popover]").popover();
}

function initTimeago(){
  $(".timeago").timeago();
}

function getLastPartOfUrl(){
  var url = $(location).attr('pathname');
    parts = url.split('/');
    //l(parts+" "+(parts.length-1));
    lastPart = parts[(parts.length-1) ];
  return lastPart;
}

function getParameterByName( name ) //courtesy Artem
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
    return decodeURIComponent(results[1].replace(/\+/g, " "));
}