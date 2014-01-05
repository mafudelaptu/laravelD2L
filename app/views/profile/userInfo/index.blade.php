
<div class="row">
	<div class="col-sm-4">
		<img alt="Avatar of {{$userData->name}}" src="{{$userData->avatarFull}}" width="100%">
	</div>
	<div class="col-sm-8">
		<div class="h2">
			<div class="pull-right">
				@include("prototypes.creditValue", array("creditValue"=> $credits))
			</div>
			{{Str::limit($userData->name, 20)}}
		</div>
		@include("profile.userInfo.userItems")
		<table width="100%">
			<tr>
				<td>Acc created:</td>
				<td align="right">{{$userData->created_at}}</td>
			</tr>
			<tr>
				<td>Last activity:</td>
				<td align="right">{{$userData->updated_at}}</td>
			</tr>
		</table>
		<div class="pull-left">
			<a href="http://dotabuff.com/players/{{$userData->id}}" target="_blank"><i
				class=" icon-tasks"></i>DotaBuff-Profile</a>
			</div>
			<div class="pull-right" align="right">
<a href="http://steamcommunity.com/profiles/{{$userData->id}}" target="_blank"><i
					class="icon-user"></i>Steam-Profile</a>
				</div>
			</div>
		</div>