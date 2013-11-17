<?php

class BanlistsController extends BaseController {

	/**
	 * Banlist Repository
	 *
	 * @var Banlist
	 */
	protected $banlist;

	public function __construct(Banlist $banlist)
	{
		$this->banlist = $banlist;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$banlists = $this->banlist->all();

		return View::make('banlists.index', compact('banlists'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('banlists.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Banlist::$rules);

		if ($validation->passes())
		{
			$this->banlist->create($input);

			return Redirect::route('banlists.index');
		}

		return Redirect::route('banlists.create')
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
		$banlist = $this->banlist->findOrFail($id);

		return View::make('banlists.show', compact('banlist'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$banlist = $this->banlist->find($id);

		if (is_null($banlist))
		{
			return Redirect::route('banlists.index');
		}

		return View::make('banlists.edit', compact('banlist'));
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
		$validation = Validator::make($input, Banlist::$rules);

		if ($validation->passes())
		{
			$banlist = $this->banlist->find($id);
			$banlist->update($input);

			return Redirect::route('banlists.show', $id);
		}

		return Redirect::route('banlists.edit', $id)
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
		$this->banlist->find($id)->delete();

		return Redirect::route('banlists.index');
	}

}
