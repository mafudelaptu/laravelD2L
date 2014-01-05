<?php

class PointtypesController extends BaseController {

	/**
	 * Pointtype Repository
	 *
	 * @var Pointtype
	 */
	protected $pointtype;

	public function __construct(Pointtype $pointtype)
	{
		$this->pointtype = $pointtype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pointtypes = $this->pointtype->all();

		return View::make('pointtypes.index', compact('pointtypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pointtypes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Pointtype::$rules);

		if ($validation->passes())
		{
			$this->pointtype->create($input);

			return Redirect::route('pointtypes.index');
		}

		return Redirect::route('pointtypes.create')
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
		$pointtype = $this->pointtype->findOrFail($id);

		return View::make('pointtypes.show', compact('pointtype'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pointtype = $this->pointtype->find($id);

		if (is_null($pointtype))
		{
			return Redirect::route('pointtypes.index');
		}

		return View::make('pointtypes.edit', compact('pointtype'));
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
		$validation = Validator::make($input, Pointtype::$rules);

		if ($validation->passes())
		{
			$pointtype = $this->pointtype->find($id);
			$pointtype->update($input);

			return Redirect::route('pointtypes.show', $id);
		}

		return Redirect::route('pointtypes.edit', $id)
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
		$this->pointtype->find($id)->delete();

		return Redirect::route('pointtypes.index');
	}

}
