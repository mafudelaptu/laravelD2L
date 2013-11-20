<?php

class FetchViewController extends BaseController {

	public function getMMInfo(){
		$modes = Input::get("modes");
		$content = View::make('findMatch/modals/mmInfo')->with("modes",$modes)->render();
		return Response::json(array("html"=>$content));
		//return View::make("findMatch/modals/mmInfo");
	}

}
