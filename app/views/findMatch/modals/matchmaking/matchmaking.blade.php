        <div class="modal-header">
                <div class="blackH2">        
                        <div class="pull-right" style="font-size:14px; width: 400px;text-align: right; text-transform: none;">
                                        Your Pool: <span id="userPoolSpan"></span>
                        </div>
                        MATCH<green>MAKING</green>
                </div>
        </div>
        
        <div class="modal-body">
                @include("findMatch.modals.matchmaking.mmStats")
                <hr>
                <div class="row">
                        <div class="col-sm-3" align="center">
                                <p>
                                        {{ HTML::image("img/matchmaking/searching.gif", "searching for players", array("width"=>100));}}
                                </p>
                                <h4>
                                        <span id="matchMakingClock"></span>
                                </h4>
                                <p>
                                        <label class="checkbox" class="t"
                                                title="enlarge your elo-search-range"> <input
                                                type="checkbox" name="forceSearching" id="forceSearching">
                                                force Searching <a href="help/faq#forceSearching" target="_blanc"><i
                                                        class="icon-question-sign"></i></a>
                                        </label>
                                </p>
                        </div>
                        <div class="col-sm-4">
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
                                                @include("findMatch.modals.matchmaking.mmInfo")
                                        </div>
                                
                        </div>
                        <div class="col-sm-5">
                                <div class="queueChat">
                                <!-- Chat includen -->
                                @include("prototypes.chat.chat", array("chatname"=>"MatchmakingChat"))
                        </div>
                        </div>
                </div>
                <br />
        </div>
        <div class="modal-footer">
                <button class="btn btn-danger" id="leaveQueueButton">Leave Queue!</button>
        </div>