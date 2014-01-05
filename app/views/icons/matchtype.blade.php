@if( $matchtype_id == 1)
	<i class="fa fa-user t" style="display: inline-block" title="{{$matchtype}}-Queue"></i>
@else
	<span class="label label-inverse t " title="{{$matchtype}}-Queue">{{$matchtype}}</span>
@endif