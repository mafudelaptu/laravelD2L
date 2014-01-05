@extends('master')

@section('content')

    <h1>{{$title}}</h1>

    <div id="faqInhaltsverzeichnis" class="well">

</div>
<div id="faqContent">
	{include "help/elo/calculationWinLoseElo.tpl"}
	{include "help/system/basePoints.tpl"}
	{include "help/elo/leaverPunishment.tpl"}
	{include "help/elo/bonusForMatchmodes.tpl"}
	{include "help/matchmaking/forceSearch.tpl"}
	{include "help/creditSystem/WhatIsTheCreditSystem.tpl"}
	{include "help/system/ladderOverview.tpl"}
	{include "help/system/generalRules.tpl"}
	

	
</div>

<div class"clearer"><br></div>
@stop