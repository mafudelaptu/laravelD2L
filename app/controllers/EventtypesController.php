<?php

class EventtypesController extends BaseController {

	/**
	 * Eventtype Repository
	 *
	 * @var Eventtype
	 */
	protected $eventtype;

	public function __construct(Eventtype $eventtype)
	{
		$this->eventtype = $eventtype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$eventtypes = $this->eventtype->all();

		return View::make('eventtypes.index', compact('eventtypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('eventtypes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Eventtype::$rules);

		if ($validation->passes())
		{
			$this->eventtype->create($input);

			return Redirect::route('eventtypes.index');
		}

		return Redirect::route('eventtypes.create')
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
		$eventtype = $this->eventtype->findOrFail($id);

		return View::make('eventtypes.show', compact('eventtype'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$eventtype = $this->eventtype->find($id);

		if (is_null($eventtype))
		{
			return Redirect::route('eventtypes.index');
		}

		return View::make('eventtypes.edit', compact('eventtype'));
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
		$validation = Validator::make($input, Eventtype::$rules);

		if ($validation->passes())
		{
			$eventtype = $this->eventtype->find($id);
			$eventtype->update($input);

			return Redirect::route('eventtypes.show', $id);
		}

		return Redirect::route('eventtypes.edit', $id)
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
		$this->eventtype->find($id)->delete();

		return Redirect::route('eventtypes.index');
	}

}
