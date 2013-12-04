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

}
