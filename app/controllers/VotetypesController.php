<?php

class VotetypesController extends BaseController {

	/**
	 * Votetype Repository
	 *
	 * @var Votetype
	 */
	protected $votetype;

	public function __construct(Votetype $votetype)
	{
		$this->votetype = $votetype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$votetypes = $this->votetype->all();

		return View::make('votetypes.index', compact('votetypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('votetypes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Votetype::$rules);

		if ($validation->passes())
		{
			$this->votetype->create($input);

			return Redirect::route('votetypes.index');
		}

		return Redirect::route('votetypes.create')
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
		$votetype = $this->votetype->findOrFail($id);

		return View::make('votetypes.show', compact('votetype'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$votetype = $this->votetype->find($id);

		if (is_null($votetype))
		{
			return Redirect::route('votetypes.index');
		}

		return View::make('votetypes.edit', compact('votetype'));
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
		$validation = Validator::make($input, Votetype::$rules);

		if ($validation->passes())
		{
			$votetype = $this->votetype->find($id);
			$votetype->update($input);

			return Redirect::route('votetypes.show', $id);
		}

		return Redirect::route('votetypes.edit', $id)
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
		$this->votetype->find($id)->delete();

		return Redirect::route('votetypes.index');
	}

}
