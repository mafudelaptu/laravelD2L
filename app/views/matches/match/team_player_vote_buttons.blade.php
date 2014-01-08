@if($voteCounts->upvotes > 0)
<button class="btn btn-sm btn-success votebutton t" value="{{$user_id}}" data-label="Upvote" data-type="1" title="upvote!">@include("icons.match_upvote")</i>&nbsp;</button>
@endif

@if($voteCounts->downvotes > 0)
<button class="btn btn-sm btn-danger votebutton t" value="{{$user_id}}" data-label="Downvote" data-type="2" title="downvote!">@include("icons.match_downvote")</i>&nbsp;</button>
@endif