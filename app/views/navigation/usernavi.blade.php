@if(Auth::check())

  <li id="fat-menu" class="dropdown">
   <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">

    {{HTML::image($userAvatar, "Avatar")}}
    {{$userName}}
    <b class="caret"></b>
  </a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
   <li>{{link_to('profile', "Profile")}}</li>
   <li>{{link_to('ladder', "Ladder")}}</li>
   <li class="divider"></li>
   <li><a tabindex="-1" href="https://dotabuff.com/players/{{Auth::user()->id}}" target="_blank">Dotabuff-Profile</a></li>
   <li><a tabindex="-1" href="http://steamcommunity.com/profiles/{{Auth::user()->id}}" target="_blank">Steam-Profile</a></li>
   <?php 
    switch (GlobalSetting::getLoginVia()) {
      case "Forum_IPBoard":
        $logoutURL = URL::to("logout");
        break;
      default:
        $logoutURL = URL::to("steamLogout");
        break;
    }
    ?>
   <li><a href="{{$logoutURL}}">Logout</a></li>
 </ul>
  </li>
 @endif