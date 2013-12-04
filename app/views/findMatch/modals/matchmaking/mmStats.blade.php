<div class="row">
        <div class="col-sm-3">
                <div class="row">
                        <div class="col-sm-3" align="center">
                                @include("prototypes/skillbracketIcon", array("sb_id"=>1, "sb_name"=>"Prison"))
                        </div>
                        <div class="col-sm-9">
                                <div class="statsNumber" id="prisonQueueCount">0</div>
                                <div class="statsDesc">Prison Player(s) in Queue</div>
                        </div>
                </div>

        </div>
        <div class="col-sm-3">
                <div class="row">
                        <div class="col-sm-3" align="center">
                                @include("prototypes/skillbracketIcon", array("sb_id"=>2, "sb_name"=>"Trainee"))
                        </div>
                        <div class="col-sm-9">
                                <div class="statsNumber" id="traineeQueueCount">0
                                </div>
                                <div class="statsDesc">Trainee Player(s) in Queue</div>
                        </div>
                </div>

        </div>
        <div class="col-sm-3">
                <div class="row">
                        <div class="col-sm-3" align="center">
                                <div class="pull-left" style="line-height: 30px;font-size: 18px;font-weight: bold;">>=</div>
                                @include("prototypes/skillbracketIcon", array("sb_id"=>3, "sb_name"=>"Amateur"))
                        </div>
                        <div class="col-sm-9">
                                <div class="statsNumber" id="amateurOrHigherQueueCount">0</div>
                                <div class="statsDesc">Amateur or higher Player(s) in Queue</div>
                        </div>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="row">
                        <div class="col-sm-3" style="line-height: 45px;" align="center">
                                <i class="icon-unlock-alt icon-2x"></i>
                        </div>
                        <div class="col-sm-9">
                                <div class="statsNumber" id="forceQueueCount">0</div>
                                <div class="statsDesc">Player(s) in Force-Queue</div>
                        </div>
                </div>

        </div>
</div>