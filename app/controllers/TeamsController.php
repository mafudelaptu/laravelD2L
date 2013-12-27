<?php

class TeamsController extends BaseController {

	/**
	 * Team Repository
	 *
	 * @var Team
	 */
	protected $team;

	public function __construct(Team $team)
	{
		$this->team = $team;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$teams = $this->team->all();

		return View::make('teams.index', compact('teams'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('teams.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Team::$rules);

		if ($validation->passes())
		{
			$this->team->create($input);

			return Redirect::route('teams.index');
		}

		return Redirect::route('teams.create')
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
		$team = $this->team->findOrFail($id);

		return View::make('teams.show', compact('team'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$team = $this->team->find($id);

		if (is_null($team))
		{
			return Redirect::route('teams.index');
		}

		return View::make('teams.edit', compact('team'));
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
		$validation = Validator::make($input, Team::$rules);

		if ($validation->passes())
		{
			$team = $this->team->find($id);
			$team->update($input);

			return Redirect::route('teams.show', $id);
		}

		return Redirect::route('teams.edit', $id)
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
		$this->team->find($id)->delete();

		return Redirect::route('teams.index');
	}

}
