<div class="row-fluid stream_row" style="line-height: 30px">
	<div class="span8">
		<a href="{$v.url}"><img alt="{{$v['Lang']}}" src="img/flags/{{$v['Lang']}}.gif">&nbsp;
			@if($v['Avatar'])
				<img alt="Avatar" src="{{$v['Avatar']}}" width="25"> <span class="t" title="{{$v['Name']}}">{$v.Name|truncate:15:"..."}</span>
			@else
				<span class="t" title="{{$v['name']}}">{{$v['name']}}</span>
			@endif
		</a>
	</div>
	<div class="span3" align="right">{{$v['viewers']}}</div>
</div>