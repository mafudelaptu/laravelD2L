@if(Auth::check())
  <li id="fat-menu" class="dropdown">
   <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
      {{$selected_region}}
    <b class="caret"></b>
  </a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="drop3" id="regionMenu">
    @foreach($regions as $region)
      <li><a tabindex="-1" href="javascript:void(0)" data-id="{{$region->id}}">{{$region->shortcut}}</a></li>
    @endforeach
   </ul>
 </li>
@endif
