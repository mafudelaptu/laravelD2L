<?php
$creditBorders = GlobalSetting::getCreditBorders();
if($creditValue < 0){
	$textClass = "text-danger";
	$iconClass = "fa fa-thumbs-down";
}
elseif($creditValue >= 0 && $creditValue < $creditBorders['bronze']){
	$textClass = "";
	$iconClass = "fa fa-thumbs-up";
}
elseif($creditValue >= $creditBorders['bronze'] && $creditValue < $creditBorders['silver']){
	$textClass = "text-bronze";
	$iconClass = "fa fa-thumbs-up";
}
elseif($creditValue >= $creditBorders['silver'] && $creditValue < $creditBorders['gold']){
	$textClass = "text-silver";
	$iconClass = "fa fa-thumbs-up";
}
elseif($creditValue >= $creditBorders['gold']){
	$textClass = "text-gold";
	$iconClass = "fa fa-thumbs-up";
}

?>

<span class="t {{$textClass}}" title="earned Creditpoints: {{$creditValue}}"><i class="{{$iconClass}}"></i>{{$creditValue}}</span>
<a href="help.php#WhatIsTheCreditSystem" target="_blank" class="t" title="What is the Credit-System and how does this work? "><i class="icon-question-sign"></i>&nbsp;</a>
