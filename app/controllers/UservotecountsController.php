<?php

class UservotecountsController extends BaseController {

	/**
	 * Uservotecount Repository
	 *
	 * @var Uservotecount
	 */
	protected $uservotecount;

	public function __construct(Uservotecount $uservotecount)
	{
		$this->uservotecount = $uservotecount;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$uservotecounts = $this->uservotecount->all();

		return View::make('uservotecounts.index', compact('uservotecounts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('uservotecounts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Uservotecount::$rules);

		if ($validation->passes())
		{
			$this->uservotecount->create($input);

			return Redirect::route('uservotecounts.index');
		}

		return Redirect::route('uservotecounts.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$uservotecount = $this->uservotecount->findOrFail($id);

		return View::make('uservotecounts.show', compact('uservotecount'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$uservotecount = $this->uservotecount->find($id);

		if (is_null($uservotecount))
		{
			return Redirect::route('uservotecounts.index');
		}

		return View::make('uservotecounts.edit', compact('uservotecount'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Uservotecount::$rules);

		if ($validation->passes())
		{
			$uservotecount = $this->uservotecount->find($id);
			$uservotecount->update($input);

			return Redirect::route('uservotecounts.show', $id);
		}

		return Redirect::route('uservotecounts.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->uservotecount->find($id)->delete();

		return Redirect::route('uservotecounts.index');
	}

}
