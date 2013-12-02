<?php

class AdminController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "admin.master";
	protected $title = "Admin Panel";

	public function home()
	{
		$this->layout->title = $this->title;
		
		$contentData = array(
			"heading" => $this->title,
			"matchtypes" => Matchtype::getAllActiveMatchtypes()->get(),
		);
		$this->layout->nest("content", 'admin.index', $contentData);

	}

}
