<?php

class SkillbrackettypesController extends BaseController {

	/**
	 * Skillbrackettype Repository
	 *
	 * @var Skillbrackettype
	 */
	protected $skillbrackettype;

	public function __construct(Skillbrackettype $skillbrackettype)
	{
		$this->skillbrackettype = $skillbrackettype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$skillbrackettypes = $this->skillbrackettype->all();

		return View::make('skillbrackettypes.index', compact('skillbrackettypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('skillbrackettypes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Skillbrackettype::$rules);

		if ($validation->passes())
		{
			$this->skillbrackettype->create($input);

			return Redirect::route('skillbrackettypes.index');
		}

		return Redirect::route('skillbrackettypes.create')
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
		$skillbrackettype = $this->skillbrackettype->findOrFail($id);

		return View::make('skillbrackettypes.show', compact('skillbrackettype'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$skillbrackettype = $this->skillbrackettype->find($id);

		if (is_null($skillbrackettype))
		{
			return Redirect::route('skillbrackettypes.index');
		}

		return View::make('skillbrackettypes.edit', compact('skillbrackettype'));
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
		$validation = Validator::make($input, Skillbrackettype::$rules);

		if ($validation->passes())
		{
			$skillbrackettype = $this->skillbrackettype->find($id);
			$skillbrackettype->update($input);

			return Redirect::route('skillbrackettypes.show', $id);
		}

		return Redirect::route('skillbrackettypes.edit', $id)
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
		$this->skillbrackettype->find($id)->delete();

		return Redirect::route('skillbrackettypes.index');
	}

}
