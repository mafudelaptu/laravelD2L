@if(Auth::check())

	@if( $count > 0)
		<?php 
			$dataToggle = "data-toggle='dropdown'";
			$label = "danger";
		 ?>
	@else
		<?php 
			$count = 0;
			$dataToggle = "";
			$label = "";
		 ?>
	@endif 
	<li id="notification-menu" class="dropdown">
		<a id="dropNotification"
		role="button" class="dropdown-toggle pointer" {{$dataToggle}}> 
			<i class="fa fa-envelope fa-2x text-{{$label}}"></i>
			@if($count > 0)
				<span class="label label-default notificationIconText"> 
					{{$count}} 
				</span>
				<b class="caret"></b>
			@endif
		</a>

		<ul class="dropdown-menu" role="menu" aria-labelledby="dropNotification">
			@if( $count > 0) 
					@if(!empty($data))
						<li>
				 			 @foreach($data as $k => $v)
				 			 	<a tabindex="-1" href="{{$v['href']}}">
				 			 		<span class="label label-info">{{$v['count']}}</span>&nbsp;{{$v['message']}}
				 			 	</a>
				 			 @endforeach
				 		</li>
				 	@endif
				@else
					<li><a tabindex="-1">No notifications</a></li>
			@endif 
		</ul>
	</li>
@endif