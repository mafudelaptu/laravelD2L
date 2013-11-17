<nav class="navbar navbar-default" role="navigation" id="topNavi">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">
     {{ HTML::image('img/dota2league-Logo-small.png', 'Logo')}}
     {{ HTML::image('img/dota2-league-text4.png', 'Logo') }}

   </a>
 </div>

 <!-- Collect the nav links, forms, and other content for toggling -->
 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">
    <li>{{ HTML::link('find_match', 'Find Match') }}</li>
    <li>{{ HTML::link('ladder', 'Ladder') }}
    <li><a href="#">Forum</a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>{{ HTML::link('faq', 'FAQ') }}</li>
        <li>{{ HTML::link('rules', 'Rules') }}</li>
      </ul>
    </li>
  </ul>
  @include("navigation.usernavi")
 </li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>