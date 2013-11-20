<div id="matchmakingModal" class="modal hide fade" tabindex="-1"
        role="dialog" aria-labelledby="matchmakingModal" aria-hidden="true">
        <div class="modal-header">
                <div class="blackH2">        
                        <div class="pull-right" style="font-size:14px; width: 400px;text-align: right; text-transform: none;">
                                        Your Pool: <span id="userPoolSpan"></span>
                        </div>
                        MATCH<green>MAKING</green>
                </div>
        </div>
        
        <div class="modal-body">
                <div class="row-fluid">
                        <div class="span3">
                                <div class="row-fluid">
                                        <div class="span3" align="center">
                                                @include("prototypes/skillbracketIcon", array("sb_id"=>1, "sb_name"=>"Prison"))
                                        </div>
                                        <div class="span9">
                                                <div class="statsNumber" id="prisonQueueCount">0</div>
                                                <div class="statsDesc">Prison Player(s) in Queue</div>
                                        </div>
                                </div>

                        </div>
                        <div class="span3">
                                <div class="row-fluid">
                                        <div class="span3" align="center">
                                                @include("prototypes/skillbracketIcon", array("sb_id"=>2, "sb_name"=>"Trainee"))
                                        </div>
                                        <div class="span9">
                                                <div class="statsNumber" id="traineeQueueCount">0
                                                </div>
                                                <div class="statsDesc">Trainee Player(s) in Queue</div>
                                        </div>
                                </div>

                        </div>
                        <div class="span3">
                                <div class="row-fluid">
                                        <div class="span3" align="center">
                                                <div class="pull-left" style="line-height: 30px;font-size: 18px;font-weight: bold;">>=</div>
                                                @include("prototypes/skillbracketIcon", array("sb_id"=>3, "sb_name"=>"Amateur"))
                                        </div>
                                        <div class="span9">
                                                <div class="statsNumber" id="amateurOrHigherQueueCount">0</div>
                                                <div class="statsDesc">Amateur or higher Player(s) in Queue</div>
                                        </div>
                                </div>
                        </div>
                        <div class="span3">
                                <div class="row-fluid">
                                        <div class="span3" style="line-height: 45px;" align="center">
                                                <i class="icon-unlock-alt icon-2x"></i>
                                        </div>
                                        <div class="span9">
                                                <div class="statsNumber" id="forceQueueCount">0</div>
                                                <div class="statsDesc">Player(s) in Force-Queue</div>
                                        </div>
                                </div>

                        </div>
                </div>
                <hr>
                <div class="row-fluid">
                        <div class="span3" align="center">
                                <p>
                                        <img src="img/searching.gif" width="100" alt="loading" />
                                </p>
                                <h4>
                                        <span id="matchMakingClock"></span>
                                </h4>
                                <p>
                                        <label class="checkbox" class="t"
                                                title="enlarge your elo-search-range"> <input
                                                type="checkbox" name="forceSearching" id="forceSearching" checked="checked">
                                                force Searching <a href="help.php#forceSearching" target="_blanc"><i
                                                        class="icon-question-sign"></i></a>
                                        </label>
                                </p>

                                <div class="alert alert-error">Can't hear sound notification? <p>Test it <a href="soundPlugin.php" target="_blank">here</a></p></div>
                        </div>
                        <div class="span4">
                                <div id="MatchmakingTimeNotification">
                                <h4 class="blackH4">
                                        <i class="icon-time"></i> MATCH<green>MAKING</green>
                                </h4>
                                        <div>
                                                Matchmaking is every minute. Next Matchmaking in <strong><span id="nextMatchmaking"></span></strong> seconds
                                        </div>
                                </div>
        
                                        <h4>Searching details</h4>
                                        <div class="MatchMakingInfo">
                                                <!-- wird durch die generateSingleQueueMatchMakingInfo in matchnmakingModal.js gefaellt  -->
                                        </div>
                                
                        </div>
                        <div class="span5">
                                <div class="queueChat">
                                <!-- Chat includen -->
                                        chat
                        </div>
                        </div>
                </div>
                <br />
        </div>
        <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"
                        id="leaveQueueButton">Leave Queue!</button>
        </div>
</div>