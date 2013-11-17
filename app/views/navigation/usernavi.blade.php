@if(Auth::check())
<ul class="nav navbar-nav navbar-right">
  <li id="fat-menu" class="dropdown">
   <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">

    {{HTML::image($userAvatar, "Avatar")}}
    {{$userName}}
    <b class="caret"></b>
  </a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
   <li><a tabindex="-1" href="profile.php?ID={{Auth::user()->id}}">Profile</a></li>
   <li><a tabindex="-1" href="ladder.php?ID={$steamID}">Ladder</a></li>
   <li class="divider"></li>
   <li><a tabindex="-1" href="https://dotabuff.com/players/{{Auth::user()->id}}" target="_blank">Dotabuff-Profile</a></li>
   <li><a tabindex="-1" href="http://steamcommunity.com/profiles/{{Auth::user()->id}}" target="_blank">Steam-Profile</a></li>
   <li><a href="logout">Logout</a></li>
 </ul>
 @endif