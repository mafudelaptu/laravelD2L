<?php

class FetchViewController extends BaseController {

	public function getMMInfo(){
		if(Auth::check()){
			if (Request::ajax()){
				$modes = Input::get("modes");
				$objModes = json_decode(json_encode($modes), FALSE);
				//var_dump($modes);
				$content = View::make('findMatch/modals/matchmaking/matchmaking')->with("modes",$objModes)->render();
				//var_dump($content);
				return Response::json(array("html"=>$content));
				//return View::make("findMatch/modals/mmInfo");
			}
		}
		
	}

	public function getReadyMatch(){
		if(Auth::check()){
			if (Request::ajax()){
				//var_dump($modes);
				$content = View::make('findMatch/modals/matchReady')->render();
				//var_dump($content);
				return Response::json(array("html"=>$content));
			}
		}
	}	

	public function getWaitingForOtherUsers(){
		if(Auth::check()){
			if (Request::ajax()){
				$matchtype_id = Input::get("matchtype_id");
				switch ($matchtype_id) {
					case 2:
						$content = View::make('findMatch/modals/waitingForOtherUsers1vs1')->render();
						break;
					
					default:
						$content = View::make('findMatch/modals/waitingForOtherUsers')->render();
						break;
				}
				
				return Response::json(array("html"=>$content));
			}
		}
	}

	public function getSubmitModal(){
		if(Auth::check()){
			if (Request::ajax()){
				$match_id = Input::get("match_id");
				
			}
		}
	}	
}
