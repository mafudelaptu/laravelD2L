<?php

class HelpController extends BaseController {

	protected $layout = "master";

	public function showRules(){
		$title = "Rules";
		$this->layout->title = $title;
		$contentData = array(
			"title"=>$title
		);
		$this->layout->nest("content", 'help.rules', $contentData);
	}

	public function showFAQ(){
		$title = "FAQ - Frequently Asked Questions";
		$this->layout->title = $title;
		$contentData = array(
			"title"=>$title
		);
		$this->layout->nest("content", 'help.faq', $contentData);
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('helps.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('helps.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('helps.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('helps.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
