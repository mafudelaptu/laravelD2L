<?php

class StreamersController extends BaseController {

	/**
	 * Streamer Repository
	 *
	 * @var Streamer
	 */
	protected $streamer;

	public function __construct(Streamer $streamer)
	{
		$this->streamer = $streamer;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$streamers = $this->streamer->all();

		return View::make('streamers.index', compact('streamers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('streamers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Streamer::$rules);

		if ($validation->passes())
		{
			$this->streamer->create($input);

			return Redirect::route('streamers.index');
		}

		return Redirect::route('streamers.create')
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
		$streamer = $this->streamer->findOrFail($id);

		return View::make('streamers.show', compact('streamer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$streamer = $this->streamer->find($id);

		if (is_null($streamer))
		{
			return Redirect::route('streamers.index');
		}

		return View::make('streamers.edit', compact('streamer'));
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
		$validation = Validator::make($input, Streamer::$rules);

		if ($validation->passes())
		{
			$streamer = $this->streamer->find($id);
			$streamer->update($input);

			return Redirect::route('streamers.show', $id);
		}

		return Redirect::route('streamers.edit', $id)
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
		$this->streamer->find($id)->delete();

		return Redirect::route('streamers.index');
	}

}
